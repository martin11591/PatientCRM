PRZYWILEJ
=

ID

Opis

Wartość

---

1, Zezwól na wyświetlanie

2, Zezwól na dodawanie

3, Zezwól na edytowanie

4, Zezwól na usuwanie

GRUPA UŻYTKOWNIKÓW
=

ID

Nazwa grupy

Prawa grupy

Administrator
-

1, Administrator, 1,2,3,4

Lekarz
-

2, Lekarz, 1,2,3,4

Recepcjonista
-

3, Recepcjonista, 1,2,3,4

Pacjent
-

4, Pacjent, 1,2,3,4

KARTA PACJENTA
=

ID użytkownika (jeden)

ID wizyt

ID chorób

ID leków

ID recept

ID lekarzy

---
PRZYKŁAD
-
---
1(kowalski), 1, null, null, null, null

RECEPTA LEKARZA
=

ID recepty

ID lekarza (użytkownika) wystawiającego

Data wystawienia

Data ważności

RECEPTA LEKARZA <-> LEKI

ID recepty (not unique)

ID leku

GRUPY LEKÓW
=

ID grupy leków

Nazwa grupy leków

LEKI
=

ID leku

Nazwa leku

ID grupy leków

Cena (średnia)

ZAMIENNIKI LEKÓW
=

ID leku

ID leku zamiennika

GRUPY CHORÓB
=

ID grupy chorób

Nazwa grupy chorób

CHOROBY
=

ID chorób

Nazwa choroby

ID grupy chorób

WSKAZANIA LEK <-> CHOROBA
=

ID leku

ID chorób

PRZECIWWSKAZANIA LEK <-> CHOROBA
=

ID leku

ID chorób
