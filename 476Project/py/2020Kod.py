#2020 ve 2019 seneleri için fakat okunacak dosya ismi loc = kisminda degistirilmeli
import xlrd
import xlwt
from geopy.geocoders import Nominatim
geolactor=Nominatim(user_agent="deneme")
def num_there(s):
    return any(i.isdigit() for i in s)
def find_Firm(row,column):
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
loc = ("kamuoyu_duyurusu_13_1_2020.xlsx") #bu kisim degistirilmeli

wb = xlrd.open_workbook(loc)
dokuman = wb.sheet_by_index(0)
addresses=[]
firms=[]
ürünler=[]
yasaklýMadde=[]
partiNums=[]
enlem=[]
boylam=[]
uygunsuzluk=[]
Tarih="2020"
markalar=[]
for i in range(dokuman.nrows):
    if  dokuman.cell_value(i, 1)!= "Firma Adý":
     column = find_Firm(i,2)
     index=column.find('/')
     index2=column.find('(')
     adresIndexi=""
     if index2!=-1:
         adresIndexi=index2-1
     else:
         adresIndexi=index
     addresses.append(column[adresIndexi+1:])
     partiNums.append(dokuman.cell_value(i,5))
     firms.append(column[:adresIndexi])
     ürünler.append(dokuman.cell_value(i,3))
     uygunsuzluk.append(dokuman.cell_value(i,4))
     markalar.append(dokuman.cell_value(i,2))
     yasaklýMadde.append(dokuman.cell_value(i,2))
     location = geolactor.geocode(column[adresIndexi+1:].replace(" ",""),timeout=10)
     try:
        enlem.append(location.latitude)
        boylam.append(location.longitude)
     except:
         enlem.append(None)
         boylam.append(None)
for i in range(0,len(addresses)):
    sheet.write(i+1,1,addresses[i])
    sheet.write(i+1,0,firms[i])
    sheet.write(i+1,4,ürünler[i])
    sheet.write(i+1,6,yasaklýMadde[i])
    sheet.write(i+1,11,Tarih)
    sheet.write(i+1,6,uygunsuzluk[i])
    sheet.write(i+1,10,partiNums[i])
    sheet.write(i+1,7,enlem[i])
    sheet.write(i+1,8,boylam[i])
    sheet.write(i+1,9,markalar[i])
urunTipleri=[]
# sonTip=""
# counter=1
# # for i in range(dokuman.nrows):
# #     if dokuman.cell_value(i,0)!="" and dokuman.cell_value(i,0)!="Kamuoyu Duyuru Tarihi":
# #         sonTip=dokuman.cell_value(i,0)
# #     elif dokuman.cell_value(i,1)!="Firma Adý":
# #         sheet.write(counter,3,sonTip)
# #         counter+=1

workbook.save("database.xls")