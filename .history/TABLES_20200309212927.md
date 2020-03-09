Privileges table
=

<pre>
+----+----------------+
| ID | Name           |
+----+----------------+
|  1 | User data      |
|  2 | Profile        |
+----+----------------+
</pre>

User or group privileges

<pre>
+----+----------+--------------+----------------+
| ID | group_id | privilege_id | privilege_mode |
+----+----------+--------------+----------------+
|  1 |        1 |            2 |           0100 |
|  2 |        1 |            1 |           0100 |
+----+----------+--------------+----------------+
</pre>

Mode is binary value (bit table):

<pre>
C | R | U | D
--+---+---+---
0 | 1 | 0 | 0 = 0100 = 4 (only read)
1 | 1 | 1 | 0 = 1110 = 14 (create, read, update, but not delete)
</pre>

             
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

KARTA PACJENTA
=

PACJENT -> ZAŻYWANE LEKI
-

ID użytkownika

ID leku

Data od

Data do

Komentarz

PACJENT -> PRZYDZIELENI LEKARZE

ID użytkownika

ID lekarza

Data od

Data do

Komentarz

WSKAZANIA LEK <-> CHOROBA
=

ID leku

ID chorób

PRZECIWWSKAZANIA LEK <-> CHOROBA
=

ID leku

ID chorób
