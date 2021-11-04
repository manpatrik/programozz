lista = ["alma", "eper", "barack", "körte"]
#          0.      1.       2.        3.
#         -4.     -3       -2.       -1.
print(lista)
print(type(lista))
print()

print(f"Lista hossza: {len(lista)}") # len() - visszaadja a lista hosszát
print(lista[0])
print(lista[3])
print(lista[len(lista) - 1])
print(lista[-1])
print(lista[-2])
print(lista[-len(lista)])
print()

index = 1 # int(input("Adj egy valós indexet!"))
while index > 3 or index < -4:
    print("Az index -4 és 3 közötti egész szám")
    index = int(input("Adj egy valós indexet!"))
print(f"{index}. elem: {lista[index]}")

lista = [1, 2, 5, 7, 7, 5, 3, 6, 9, 7, 4, 2, 5, 3]
# megszámlálás
# hány db ötös van?
db = 0
i = 0
while i < len(lista):
    if lista[i] == 5:
        db += 1
    i += 1
print(f"{db} db ötös van")

# összegzés
# írjuk ki a számok összegét!
osszeg = 0
i = 0
while i < len(lista):
    osszeg += lista[i]
    i += 1
print(osszeg)
print()

# töltsünk fel egy listát 1-től 50-ig egész számokkal
szamok = []
i = 1
while i <= 50:
    szamok.append(i) # append() - hozzáfűzi a listához a paraméterben adott értéket
    i += 1
print(szamok)
print()

# tároljuk el külön listában a páros és páratlan számokat! (első 20 szám)
paros = []
paratlan = []
i = 1
while i <= 20:
    if i % 2 == 0:
        paros.append(i)
    else:
        paratlan.append(i)
    i += 1
print(f"Párosak: {paros}")
print(f"Páratlanok: {paratlan}")
print()

# cseréljük fel az összes elemet!
lista1 = [1, 2, 3, 4, 5]
lista2 = [11, 22, 33, 44, 55]
print(f"eredeti lista1: {lista1}")
print(f"eredeti lista2: {lista2}\n")
i = 0
while i < len(lista1):
    temp = lista1[i]
    lista1[i] = lista2[i]
    lista2[i] = temp
    i += 1
print(f"cserélt lista1: {lista1}")
print(f"cserélt lista2: {lista2}\n")

# listaműveletek
gyumolcsok = ["alma", "eper", "barack", "körte"]
print(gyumolcsok)
gyumolcsok.append("dinnye") # hozzáfűzi a listához a paraméterben adott értéket (1 elemet)
print(gyumolcsok)
gyumolcsok.insert(2, "szőlő") # beszúrja a paramaméterben adott indexű helyre az értéket (1 elemet)
gyumolcsok.insert(4, "málna")
print(gyumolcsok)
gyumolcsok.pop() # törli az utolsó elemet
print(gyumolcsok)
gyumolcsok.pop(1) # törli a paraméterben adott indexű elemet
print(gyumolcsok)
gyumolcsok.remove("barack") # törli a paraméterben adott elemet
print(gyumolcsok)