def legnagyobb(*szamok):
    maximum = 0
    for szam in szamok:
        if maximum < szam:
            maximum = szam
    return maximum

print(legnagyobb(12,5,3,6,5,15))