<?php 
    require_once "../connect/dbCon.php";
    if (isset($_POST['current-bookingID'])) {
        $query = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, US.email, US.contactnumber, US.address, BK.*, 
                    AG.agencyManID, AG.agencyPfPicture, AG.agencyName, AG.agencyEmail, AG.agencyTelNumber, PK.packageCreator, 
                    PK.packageTitle, PK.packagePrice, PK.packagePriceChild, PK.packagePriceSenior, PK.packagePersonMax, 
                    PK.packagePersonMin, PK.packageStartDate, PK.packageEndDate, PK.packageSlots,`timestamp`
                    FROM inquiry_tbl AS IQ
                    INNER JOIN user_tbl AS US ON IQ.id_user = US.id
                    INNER JOIN booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                    INNER JOIN package_tbl AS PK ON IQ.packageID = PK.packageID
                    INNER JOIN agency_tbl AS AG ON PK.packageCreator = AG.agencyID
                    INNER JOIN bookingstatus_tbl AS BS ON BK.bookingID = BS.bookingInfoID
                    WHERE BK.bookingID = {$_POST['current-bookingID']} AND BS.bookingStatus = 'pay-pending'";

        $qry_receipt = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($qry_receipt);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Lakbayan | Receipt</title>

		<link rel="icon" href="../../assets/img/logo.png" />
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/receipt.css">

		<!-- CDN URL - html2pdf library -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	</head>

	<body>
		
		<div class="invoice-box" id="toPDF">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<?php 
									if (is_null($row['agencyPfPicture'])) {
										$src = "../../assets/img/users/travelagent/DefaultAgent.png";
									} else {
										$src = "../../assets/img/users/travelagent/{$row['packageCreator']}/pfp/{$row['agencyPfPicture']}";
									}
									?>
									<img src=<?php echo $src; ?> alt="Company logo" />
									<h4><?php echo $row['agencyName']?></h4>
								</td>

								<td>
									Booking #: <?php echo $row['bookingNumber']?><br />
									Booking Date: <?php echo date_format(date_create($row['timestamp']),"m/d/Y");?><br />
									Trip Start: <?php echo date_format(date_create($row['packageStartDate']),"m/d/Y");?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
                                    <?php echo $row['agencyName']?><br />
									<?php echo $row['agencyEmail']?><br />
									<?php if (!is_null($row['agencyTelNumber'])) echo $row['agencyTelNumber']?>
								</td>

								<td>
                                    <?php echo $row['fullname']?><br />
									<?php echo $row['email']?><br />
									<?php if (!is_null($row['contactnumber'])) echo $row['contactnumber']?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Transaction #</td>
				</tr>

				<tr class="details">
					<td>Paymongo</td>

					<td><?php echo $row['bookingTransacNum']?></td>
				</tr>

				<tr class="heading">
					<td><?php echo $row['packageTitle']?></td>

					<td></td>
				</tr>

			<?php 
				$gtotal = 0;
				if ($row['packagePriceChild'] != 0 and $row['packagePriceSenior'] != 0) { 
					if ($row['childrenCount'] > 0) {
						$row['childrenCount'] > 1 ? $prefix = "Children" : $prefix = "Child";
						$price = $row['childrenCount'] * $row['packagePriceChild'];
						echo<<<END
						<tr class="item">
							<td> 
								₱{$row['packagePriceChild']} x {$row['childrenCount']} $prefix
							</td>
	
							<td>₱$price</td>
						</tr>
						END;
						$gtotal += $price;
					}
					if ($row['adultCount'] > 0) {
						$row['adultCount'] > 1 ? $prefix = "Adults" : $prefix = "Adult";
						$price = $row['adultCount'] * $row['packagePrice'];
						echo<<<END
						<tr class="item">
							<td> 
								₱{$row['packagePrice']} x {$row['adultCount']} $prefix
							</td>
	
							<td>₱$price</td>
						</tr>
						END;
						$gtotal += $price;
					}
					if ($row['seniorCount'] > 0) {
						$row['seniorCount'] > 1 ? $prefix = "Children" : $prefix = "Child";
						$price = $row['seniorCount'] * $row['packagePriceSenior'];
						echo<<<END
						<tr class="item">
							<td> 
								₱{$row['packagePriceSenior']} x {$row['seniorCount']} $prefix
							</td>
	
							<td>₱$price</td>
						</tr>
						END;
						$gtotal += $price;
					}
					
				} else {
					$totalpersons = (int)$row['childrenCount'] + (int)$row['adultCount'] + (int)$row['seniorCount'];
					if ($totalpersons > 0) {
						$totalpersons > 1 ? $prefix = "Persons" : $prefix = "Person";
						$price = $totalpersons * $row['packagePrice'];
						echo<<<END
						<tr class="item">
							<td> 
								₱{$row['packagePrice']} x $totalpersons $prefix
							</td>
	
							<td>₱$price</td>
						</tr>
						END;
						$gtotal += $price;
					}
				}
			?>
				

				<tr class="total">
					<td>Total Price</td>

					<td>₱<?php echo $gtotal; ?></td>
				</tr>
			</table>
		</div>
		<script>
			var pdfContent = document.querySelector("#toPDF");
			var optionArray = {
			filename:     '<?php echo "Lakbayan-{$row['agencyName']}-{$row['bookingNumber']}"?>.pdf',
			jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
			};

			// html to pdf generation with the reference of PDF worker object
			html2pdf().set(optionArray).from(pdfContent).save();
		</script>
	</body>
</html>
<?php 
    }
?>