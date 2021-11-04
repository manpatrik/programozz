# Task 1
my_name = "Alex"
print("My name is " + my_name)
print("")

# Task 2
my_age = 34
# Give us an error. What to do?
#  print("I'm " + my_age + " years old!")

# Convert the number to string
print("I'm " + str(my_age) + " years old!")
print("")

# Task 3

pet_name = "Mr.hamster"
pet_age = 3
pet_species = "Hamster"

print("My first pet called: " + pet_name + " and he is " + str(pet_age) + " years old. He is a " + pet_species)

pet_name = "Hunter"
pet_age = 9
pet_species = "Dog"

print("My second pet called: " + pet_name + " and he is " + str(pet_age) + " years old. He is a " + pet_species)
print("")

# Task 4
# the variables have been created in task 1 and 2
print("My name is %s" %my_name)
print("")
# Task 5
print("Hello! My name is %s and i am %d years old" %(my_name, my_age))
print("")

# Task 6
thing_1 = input("Give me a thing:\n")  # card
thing_2 = input("Give me another thing:\n")  # desk
adjective = input("Give me an adjective:\n")  # beautiful
song_title = input("Give me a song title:\n")  # Thunderstruck
celebrity = input("Give me a celebrity name:\n")  # Tom Holland
feeling = input("Give me an emotion:\n")  # sad
verb = input("Give me a verb:\n")  # cook
place = input("Give me a place:\n")  # home
food = input("Give me a food:\n")  # burger
person = input("Give me person/name:\n")  # Anna

print("""
I just got back from a pizza party with %s. 
Can you believe we got to eat %s pizza in %s?! 
Everyone got to choose their own toppings. 
I made '%s and %s' pizza, which is my favorite! 
They even stuffed the crust with %s. How %s! 
If that wasn't good enough already, %s was there singing %s. 
I was so inspired by the music, I had to get up out of my seat and %s.

""" %(person, adjective, place, food, thing_1, thing_2, feeling, celebrity, song_title, verb))

# a little more time, but you can definitely find the variables easier in the story
print("I just got back from a pizza party with " + person +". Can you believe we got to eat " + adjective +
      "\npizza in " + place + "?! Everyone got to choose their own toppings. I made '" + food + " and " + thing_1 +
      "'\npizza, which is my favorite! They even stuffed the crust with " + thing_2 + ". How " + feeling +
      "!\nIf that wasn't good enough already, " + celebrity + " was there singing " + song_title +
      ".\nI was so inspired by the music, I had to get up out of my seat and " + verb + ".")

# STATEMENTS

# Task 7 - Handling different types of variables
num = 5
word = "cat"
is_boy = True
is_animal = False

# Task 8 - is and if else statements
if num:
    print("It's a number")
if word:
    print("It's a word")
if is_boy:
    print("It's a boy")
if is_animal:
    print("It's an animal")
else:
    print("It's not an animal")
print("")

# Task 9 - <, > operators
number_1 = 8
number_2 = 23
if number_1 > number_2:
    print("Number 1 is bigger.")
if number_2 < number_2:
    print("Number 2 is bigger.")
print("")

# Task 10 - == and elif statement
a1 = int(input("Give me a number:\n"))
b1 = int(input("Give me another number:\n"))
if a1 == b1:
    print("They are equal!")
elif a1 > b1:
    print("The first number is bigger.")
else:
    print("The second number is bigger.")
print("")

# Task 11 - making a grade system
point = input("Give me a point:\n")
if int(point) >= 90:
    print("You got an A")
elif int(point) >= 75:
    print("You got an B")
elif int(point) >= 60:
    print("You got an C")
elif int(point) >= 45:
    print("You got an D")
else:
    print("You got an E")

print("")
















