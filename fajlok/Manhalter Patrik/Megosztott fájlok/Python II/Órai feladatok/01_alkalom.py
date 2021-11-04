def hello_vilag():
    print("Hello világ!")

hello_vilag()

def prim_e(a):
    for i in range(2, a):
        if a % i == 0:
            return False
    return "Ez egy prím szám"

# szam = int(input("Írj be egy számot!"))
# print(prim_e(szam))

def derekszogu_e(a, b, c):
    if (a ** 2 + b ** 2 == c ** 2) or (a ** 2 + c ** 2 == b ** 2) or (c ** 2 + b ** 2 == a ** 2):
        return "derékszögű!"
    else:
        return "nem derékszögű!"

print(derekszogu_e(3, 4, 5))
print(derekszogu_e(4, 5, 6))

def kivonas(a, b):
    return a - b

print(kivonas(10, 5))
print(kivonas(b=5, a=10))

def x_valt():
    x = 20
    print(x)

x = 10
print(x) # 10
x_valt() # 20
print(x) # 10

def szemely (nev, kor, lakcim = -1):
    if lakcim == -1:
        print(f"{nev}, {kor}")
    else:
        print(f"{nev}, {kor}, {lakcim}")

szemely("patrik", 21, "Baja")

def osszeg(* szam):
    sum = 0
    for i in szam:
        sum += i
    print(sum)

osszeg(1, 2, 3 , 4, 5)
