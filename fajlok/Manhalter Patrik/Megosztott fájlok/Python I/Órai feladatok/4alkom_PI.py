print("aritmetikai operátorok:")
print(2 + 5) # 7
print(8 - 4) # 4
print(2 * 4) # 8
print(9 / 2 ) # 4.5
print(9 / 3) # 3.0
print(9 // 2) # 4 (egész osztás, lefele kerekít)
print(9 % 6) # 3 (maradék)
print(3 ** 3) # 27 (3^3 = 3*3*3 = 27 hatványozás)
print()

print("értékadó operátorok:")
szam = 8
print(szam) # 8
szam += 5
print(szam) # 13
szam -= 2
print(szam) # 11
szam *= 3
print(szam) # 33
szam /= 3
print(szam) # 11.0
szam %= 3
print(szam) # 2.0
szam **= 4
print(szam) # 16.0
print()

print("összehasonlító operátorok")
print(szam == 8)
print(szam == 16)
print(szam > 8)
print(szam < 8)
print(szam >= 8)
print(szam - 2 == 14)
print()

szo = "hello"
szo2 = "valami"
szoveg = "hello vilag"
print(szo in szoveg)
print(szo2 in szoveg)
print("@" in szoveg)

print("Gondolj egy állatra (strucc, pingvin, galamb, lunda, teve, ló, lepke)")

if input("2-nél több lába van?").lower() == "igen":
    ketto = True
else:
    ketto = False

if input("tud-e repülni?").lower() == "igen":
    repul = True
else:
    repul = False

if input("tud-e úszni?").lower() == "igen":
    uszni = True
else:
    uszni = False


if ketto :
    if repul:
        print("lepke")
    else:
        if uszni:
            print("ló")
        else:
            print("teve")
else:
    if repul:
        if uszni:
            print("lunda")
        else:
            print("galamb")
    else:
        if uszni:
            print("pingvin")
        else:
            print("strucc")
