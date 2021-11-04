# Hozz létre egy listát a hét napjaival!
napok = ["hétfő", "kedd", "szerda", "csütörtök", "péntek", "szombat", "vasárnap"]

# Tárold el egy listában az első 20db 6-al és 8-el osztható számokat
i = 1
eredmeny = []
while len(eredmeny) < 20:
    if i % 6 == 0 and i % 8 == 0: # i % 24 == 0
        eredmeny.append(i)
    i += 1
print(eredmeny)
# kérj be egy sorszámot és töröld ki az előző listából azt az elemet!
sorszam = int(input("adj meg egy számot"))
eredmeny.pop(sorszam - 1)
print(eredmeny)
# Január 1-én péntek volt 2021-ben.
# kérd be, hogy ma hanyadik nap van az évben és irasd ki milyen nap van!