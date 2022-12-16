from tableauscraper import TableauScraper as TS
from fuzzywuzzy import process, fuzz
import pandas as pd
import os
import json

url = "https://public.tableau.com/views/COVID-19CasesandDeathsinthePhilippines_15866705872710/Cases?%3AshowVizHome=no"

ts = TS()
ts.loads(url)

ws = (ts.getWorksheet("C_Table")).data

# Data Cleaning
ws = ws.drop(ws[ws['ProvinceCity Clean-value'] == "%null%"].index)
clean_columns = ws[["ProvinceCity Clean-value", "RegionRes Clean-value", "Measure Names-alias", "Measure Values-alias"]]
clean_columns.columns = ['Municipality', 'Region', 'Measures', 'Value']

# Pivot Table Contents
final_df = clean_columns.pivot_table(index=['Region', 'Municipality'],
                          columns=['Measures'],
                          values='Value',
                          aggfunc=lambda x: ' '.join(x))

# Export to CSV
final_df.to_csv(os.getcwd() + '/public_html/backend/webscrape/covidData.csv', index=True)


# Adding COVID-19 data to geoJson files
def getMunicipalityList():
    # Import from existing CSV
    filepath = os.getcwd() + "/public_html/backend/webscrape"
    df = pd.read_csv(filepath + "/covidData.csv")
    fmuni = df['Municipality'].tolist()
   
    fullpath = os.getcwd() + "/public_html/geojson"
    dir_list = os.listdir(fullpath)
    
    count = 0
    for file in dir_list:
        file = (fullpath+"/"+file)
        print(file)
        with open(file, "r") as jsonFile:
            data = json.load(jsonFile)
            for i in range(0, len(data['features'])):
                pr = str()
                # if "ph18-" in file or "ph0" in file:
                #     pr = data['features'][i]['properties']['name'].upper() 
                # else:
                pr = data['features'][i]['properties']['province'].upper()
                
                match = process.extractOne(pr, fmuni, scorer=fuzz.token_sort_ratio)
                cases = df.loc[df['Municipality'] == match[0], 'Active Cases'].iloc[0]
                deaths = df.loc[df['Municipality'] == match[0], 'Deaths'].iloc[0]
                deathrate = df.loc[df['Municipality'] == match[0], 'Fatality Rate'].iloc[0]
                newcases = df.loc[df['Municipality'] == match[0], 'New Cases'].iloc[0]
                population = df.loc[df['Municipality'] == match[0], 'ProvinceCityPopulation'].iloc[0]
                recovery = df.loc[df['Municipality'] == match[0], 'Recoveries'].iloc[0]
                recoveryrate = df.loc[df['Municipality'] == match[0], 'Recovery Rate'].iloc[0]
                totalcases = df.loc[df['Municipality'] == match[0], 'Total Cases'].iloc[0]

                data['features'][i]['properties']['cases'] = str(cases)
                data['features'][i]['properties']['deaths'] = str(deaths)
                data['features'][i]['properties']['deathrate'] = str(deathrate)
                data['features'][i]['properties']['newcases'] = str(newcases)
                data['features'][i]['properties']['population'] = str(population)
                data['features'][i]['properties']['recovery'] = str(recovery)
                data['features'][i]['properties']['recoveryrate'] = str(recoveryrate)
                data['features'][i]['properties']['totalcases'] = str(totalcases)

                print(data['features'][i]['properties']['cases'])
                
        with open(file, "w") as jsonFile:
            json.dump(data, jsonFile)


getMunicipalityList()

# Cleaning geoJson files
# def cleanJson():
### For initial cleaning and formatting of geojson files only
# Clean files #1-17
    # for i in range(1, 18):
    #     filename = f"backend/webscrape/geojson/provinces-region-ph{i}.json"
    #     keys = ["Shape_Leng", "Shape_Area", "ADM2_PCODE", "ADM2_REF", "ADM2ALT2EN",
    #             "ADM1_PCODE", "ADM0_EN", "ADM2ALT1EN", "ADM0_PCODE", "date", "validOn"]

    #     with open(filename, "r") as jsonFile:
    #         data = json.load(jsonFile)

    #         for i in range(0, len(data['features'])):
    #             for key in keys:
    #                 data['features'][i]['properties'].pop(key)
    #             data['features'][i]['properties']['province'] = data['features'][i]['properties'].pop(
    #                 "ADM2_EN")
    #             data['features'][i]['properties']['region'] = data['features'][i]['properties'].pop(
    #                 "ADM1_EN")
    #             data['features'][i]['properties']['province'] = data['features'][i]['properties']['province'].upper()
    #             # print(data['features'][i]['properties'])
    #             # geo_muni.append(data['features'][i]['properties']['province'])

    #     with open(filename, "w") as jsonFile:
    #         json.dump(data, jsonFile)

# Clean file #18
    # for j in range(1, 5):
    #     filename = f"backend/webscrape/geojson/provinces-region-ph18-{j}.json"
    #     if j != 1:
    #         keys = ["Shape_Leng", "Shape_Area", "ADM3_PCODE", "ADM3_REF", "ADM3ALT1EN",
    #                 "ADM3ALT2EN", "ADM2_PCODE", "ADM1_PCODE", "ADM0_EN", "ADM0_PCODE", "date", "validOn"]
    #     else:
    #         # filename = f"backend/webscrape/geojson/provinces-region-ph18.json"
    #         keys = ["Shape_Leng", "Shape_Area", "ADM2_PCODE", "ADM2_REF", "ADM2ALT2EN",
    #                 "ADM1_PCODE", "ADM0_EN", "ADM2ALT1EN", "ADM0_PCODE", "date", "validOn"]

    #     with open(filename, "r") as jsonFile:
    #         data = json.load(jsonFile)

    #         for i in range(0, len(data['features'])):
    #             for key in keys:
    #                 data['features'][i]['properties'].pop(key)

    #             data['features'][i]['properties']['province'] = data['features'][i]['properties'].pop(
    #                 "ADM2_EN")
    #             data['features'][i]['properties']['province'] = data['features'][i]['properties']['province'].upper()
    #             data['features'][i]['properties']['region'] = data['features'][i]['properties'].pop(
    #                 "ADM1_EN")
    #             if j != 1:
    #                 data['features'][i]['properties']['name'] = data['features'][i]['properties'].pop(
    #                     "ADM3_EN")
    #                 data['features'][i]['properties']['name'] = data['features'][i]['properties']['name'].upper()
    #                 # geo_muni.append(data['features'][i]['properties']['name'])
    #             # else:
    #                 # geo_muni.append(data['features'][i]['properties']['province'])

    #     with open(filename, "w") as jsonFile:
    #         json.dump(data, jsonFile)

# Clean file #19
    # filename = f"backend/webscrape/geojson/provinces-region-ph19.json"
    # keys = ["Shape_Leng", "Shape_Area", "ADM3_PCODE", "ADM3_REF", "ADM3ALT1EN",
    #         "ADM3ALT2EN", "ADM2_PCODE", "ADM1_PCODE", "ADM0_EN", "ADM0_PCODE", "date", "validOn"]

    # with open(filename, "r") as jsonFile:
    #         data = json.load(jsonFile)

    #         for i in range(0, len(data['features'])):
    #             for key in keys:
    #                 data['features'][i]['properties'].pop(key)

    #             data['features'][i]['properties']['province'] = data['features'][i]['properties'].pop(
    #                 "ADM2_EN")
    #             data['features'][i]['properties']['province'] = data['features'][i]['properties']['province'].upper()
    #             data['features'][i]['properties']['region'] = data['features'][i]['properties'].pop(
    #                 "ADM1_EN")
                
    #             data['features'][i]['properties']['name'] = data['features'][i]['properties'].pop(
    #                 "ADM3_EN")
    #             data['features'][i]['properties']['name'] = data['features'][i]['properties']['name'].upper()
    #                 # geo_muni.append(data['features'][i]['properties']['name'])
    #             # else:
    #                 # geo_muni.append(data['features'][i]['properties']['province'])

    # with open(filename, "w") as jsonFile:
    #     json.dump(data, jsonFile)

# cleanJson()