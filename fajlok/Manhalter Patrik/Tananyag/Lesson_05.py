# Task 1 - Arithmetic operators
print(5 + 5)
print(6 - 4)
print(9 * 10)
print(9 / 3) # 3.0
print(9 / 2) # 4.5
print(7 % 4) # 3
print(3 ** 3) # hatványozás
print(99 / 4) # 24.75
print(99 // 4) #24
print("változók módosításai")

# Task 2 - változók módosításai
num = 8
print(num)
num += 7
print(num) # 15
num -= 6
print(num) # 9
num *= 5
print(num) # 45
num /= 4
print(num)  # 11.25
num **= 2
print(num) # 126.5625
num %= 2
print(num) # 0.5625
print("összehasonlító operators")

# Task 3 - összehasonlító operators
print(5 < 4)
print(32 > 9)
print(9 == 45)
print(9 * 5 == 45)
print("")

# Task 4

print("Identity operator")
# Task 5 - Identity operator
# Working but the IDE gives us an error
print(5 is 5)
print(8 is 9)
print(6 is "peach")
print("")

# Proper use case of this operator
x1 = 5
x2 = 5
x3 = 8
y1 = "random name"
y2 = "random animal"
print(x1 is x2)
print(x1 is x3)
print(x1 is y1)
print(y1 is y1)
print(y1 is y2)
print("membership operator")
# Task 6 - membership operator

z1 = 'H'
z2 = 'K'
z3 = "world"
word = "Hello world"
print(z1 in word)
print(z2 in word)
print(z3 in word)

# Task 7 - use operators in if statements
a1 = 4
a2 = 7
if a1 < a2:
    print(str(a1) + " is smaller than " + str(a2))
if a1 ** a2 == a2 ** a1:
     print(str(a1) + "^" + str(a2) + " equals to " + str(a2) + "^" + str(a1))
if a1 ** a2 != a2 ** a1:
     print(str(a1) + "^" + str(a2) + " not equals to " + str(a2) + "^" + str(a1))

# Task 8 - email address validity
address = "manyme@logiscool.com"
if "@" in address and ( address.endswith(".com") or address.endswith(".hu")):
    print("Valid address")
else:
    print("Invalid address")

# Task 9 - value of a number
number = float(input("Enter a number!\n"))
if number >= 0:
    if number == 0:
        print("Zero")
    else:
        print("Positive number")
else:
    print("Negative number")

# Task 10 - which one is the greatest
a = float(input("Enter the first number!\n"))
b = float(input("Enter the second number!\n"))
c = float(input("Enter the third number!\n"))
if a > b:
    if a > c:
        print(str(a) + " is the greatest number.")
    elif c > a:
        print(str(c) + " is the greatest number.")
    else:
        print("There are multiple greatest numbers here.")
elif b > a:
    if b > c:
        print(str(b) + " is the greatest number.")
    elif c > b:
        print(str(c) + " is the greatest number.")
    else:
        print("There are multiple greatest numbers here.")
else:
    print("There are multiple greatest numbers here.")

# Task 11 - I thought of an animal
#
animal_leg = int(input("Has 2 or 4 legs?"))
animal_fly = input("Can fly?")
animal_swim = input("Can swim?")
if animal_leg == 2:
    if animal_fly.lower() == "yes":
        if animal_swim.lower == "yes":
            print("It's an lunda")
        else:
            print("It's a galamb")
    elif animal_fly.lower == "no":
        if animal_swim.lower == "yes":
            print("It's a penguin")
        else:
            print("It's a kiwi")

elif animal_leg == 4:
    if animal_fly.lower == "yes":
        if animal_swim.lower == "yes":
            print("There is no such animal...(except a pegasus)")
        else:
            print("It's a butterfly")
    elif animal_fly.lower == "no":
        if animal_swim.lower == "yes":
            print("It's a horse")
        else:
            print("It's a camel")
