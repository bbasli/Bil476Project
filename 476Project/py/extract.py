##Kamuoyu_Duyurusu_20201.pdf,Kamuoyu_Duyurusu.pdf için ( uygunsuzluk kısmı ayrı bir sütun olarak verilince)
import xlrd
import xlwt
from geopy.geocoders import Nominatim
geolactor=Nominatim(user_agent="deneme")
def num_there(s):
    return any(i.isdigit() for i in s)
def find_Firm(row,column):
    wb = xlrd.open_workbook(loc)
    dokuman = wb.sheet_by_index(0)
    firm=""
    while True:
        firm=dokuman.cell_value(row,column-1)
        if firm!="":
            break
        row-=1
    return firm
workbook = xlwt.Workbook()
sheet = workbook.add_sheet("Sheet Name",cell_overwrite_ok=True)
style = xlwt.easyxf('font: bold 1')
sheet.write(0, 0, 'Firma', style)
sheet.write(0, 1, 'Adres', style)
sheet.write(0, 2, 'Ürün Tipi', style)
sheet.write(0, 3, 'Ürün Kategorisi', style)
sheet.write(0, 4, 'Ürün', style)
sheet.write(0, 5, 'Hile Gerekçesi', style)
sheet.write(0, 6, 'Etken Madde', style)
sheet.write(0, 7, 'Enlem', style)
sheet.write(0, 8, 'Boylam', style)
sheet.write(0, 9, 'Marka', style)
sheet.write(0, 10, 'Parti/Seri No', style)
sheet.write(0, 11, 'Tarih', style)
loc = "Kamuoyu_Duyurusu.xlsx"

wb = xlrd.open_workbook(loc)
dokuman = wb.sheet_by_index(0)
addresses=[]
firms=[]
ürünler=[]
yasaklıMadde=[]
partiNums=[]
enlem=[]
boylam=[]
Tarih="2018"
markalar=[]
for i in range(dokuman.nrows):
    if dokuman.cell_value(i,1) !="" and dokuman.cell_value(i,1)!="Firma Adı":
        column = find_Firm(i,2)

        adresIndexi = column.find('(')
        if adresIndexi !=-1:
            location = geolactor.geocode(column[adresIndexi + 1:].replace(" ", ""), timeout=10)
        if adresIndexi == -1:
            adresIndexi = column.rindex(" ")
            location = geolactor.geocode(column[adresIndexi + 1:].replace(" ", ""), timeout=10)
        addresses.append(column[adresIndexi+1:])
        firms.append(column[:adresIndexi])
        if dokuman.cell_value(i,2).find('(')!=-1:
            ürünler.append(dokuman.cell_value(i,3))
            yasaklıMadde.append(dokuman.cell_value(i,4))
        else:
            ürünler.append(dokuman.cell_value(i, 3))
            yasaklıMadde.append(dokuman.cell_value(i, 4))
        partiNums.append(dokuman.cell_value(i,5))
        markalar.append(dokuman.cell_value(i,2))
        print(location)
        try:
            enlem.append(location.latitude)
            boylam.append(location.longitude)
        except:
            enlem.append(None)
            boylam.append(None)
for i in range(0,len(addresses)):
    sheet.write(i+1,1,addresses[i])
    sheet.write(i+1,0,firms[i])
    sheet.write(i+1,6,ürünler[i])
    sheet.write(i+1,4,yasaklıMadde[i])
    sheet.write(i+1,11,Tarih)
    sheet.write(i+1,10,partiNums[i])
    sheet.write(i+1,7,enlem[i])
    sheet.write(i+1,8,boylam[i])
    sheet.write(i+1,9,markalar[i])
urunTipleri=[]
sonTip=""
counter=1
# for i in range(dokuman.nrows):
#     if dokuman.cell_value(i,0)!="":
#         sonTip=dokuman.cell_value(i,0)
#     elif dokuman.cell_value(i,1)!="Firma Adı":
#         sheet.write(counter,3,sonTip)
#         counter+=1

workbook.save("database.xls")