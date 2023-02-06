# necessary imports for webscraping
from bs4 import BeautifulSoup
import requests
import json

with open ("Democratie-index.html", "r") as html_file:
    content = html_file.read()
soup = BeautifulSoup(content, "lxml")
table_soup = soup.find_all('table')
filtered_table_soup = [table for table in table_soup if table.caption is not None]


required_table = None

for table in filtered_table_soup:
    if str(table.caption.string).strip() == 'overzicht':
        required_table = table
        break

rows = []

# Find all `tr` tags
data_rows = required_table.find_all('tr')

for row in data_rows:
    value = row.find_all('td')
    beautified_value = [ele.text.strip() for ele in value]
    # Remove data arrays that are empty
    if len(beautified_value) == 0:
        continue
    rows.append(beautified_value)

#print(rows)

land_array = [["Argentinië"], ["Verenigde Staten"], ["Brazilië"], ["Canada"], 
["Cuba"], ["Haïti"], ["Dominicaanse Republiek"], ["Mexico"], ["Guatemala"], 
["Belize"], ["El Salvador"], ["Honduras"], ["Nicaragua"], ["Costa Rica"]
, ["Panama"], ["Colombia"], ["Venezuela"], ["Ecuador"], ["Guyana"], ["Suriname"]
, ["Peru"], ["Bolivia"], ["Paraguay"], ["Uruguay"], ["Chili"]
]

for i in land_array:
    # check if substring in string
    for e in rows:
        #print('hello')
        if i[0] in e[1]:
            #print('hello')
            for q in range(2, 9):
                i.append(e[q])
            #print(i)


jsonString = json.dumps(land_array)
jsonFile = open("data.json", "w")
jsonFile.write(jsonString)
jsonFile.close()