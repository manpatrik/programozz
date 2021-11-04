# Task 1 - Use input inside the print command.
print(input("Hello World"))
# Task 2 - Replacing the 'a' characters to 'e'
print(input("Give me a poem:\n").replace('a', 'e'))
# Task 3 - Make the text uppercase/lowercase
print(input("Give me a poem:\n").upper())
# Task 4 - Change the first letter of the words
print(input("Give me a poem:\n").title()) #make the first letter in each word upper case
print(input("Give me a poem:\n").capitalize()) #upper case the first letter in this sentence
# Task 5 - Returns the length of the text
print(input("Give me a poem:\n").__len__())
# Task 6 - Split the text at different characters
print(input("Give me a poem:\n").split(' ')) #split at whitespace
print(input("Give me a poem:\n").split('a')) #split at letter a
#Task 7 - Count something specific in a string
print(input("Give me a poem:\n").count('a'))
 # Task 8 - Find a specific character or word in the text
 # Note: Tt returns the index of first occurrence of the substring, or it returns -1, if the substring is not found.
print(input("Give me a poem:\n").find('e'))
print(input("Give me a poem:\n").find("lamb"))

# Task 9 - Examine the string to see if it starts or ends which a specific character
# If it returns True, then the text starts/ends with that character, if not then it returns False
print(input("Give me a poem:\n").startswith('M'))
print(input("Give me a poem:\n").endswith('w'))

# Task 10 - You can check if the string is decimal, alphabetic, digit, uppercase or lowercase
print(input("Give me a poem:\n").isdecimal())
print(input("Give me a poem:\n").isnumeric())
print(input("Give me a poem:\n").isalpha())
print(input("Give me a poem:\n").isupper())
print(input("Give me a poem:\n").islower())


