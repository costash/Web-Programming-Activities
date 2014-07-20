*** Tema 3 PW ***
*** Aprilie 2014 ***
*** Constantin Șerban-Rădoi 342C5 ***

** Access Control Flaws **
	* Using an Access Control Matrix *
		- Aici am luat trial and error, al 2-lea user + Account Manager' a mers.
	* Bypass a Path Based Access Control Scheme *
		- Aici am modificat din Chrome Developer tools form-ul pentru a-mi
			genera un request către resursa cerută folosind calea relativă '..'
	* LAB: Role Based Access Control *
		* Stage 1: Bypass Business Layer Access Control
			- Aici am modificat action pentru unul din butoane la valoarea
				'DeleteProfile'
		* Stage 2: Add Business Layer Access Control
			! Necesită WebGoat developer.
			- E suficient să fie adăugată o verificare isAuthorized în codul
				Java
		* Stage 3: Bypass Data Layer Access Control
			- Aici e suficient să editez URL-ul și să adaug parametrii GET
				employee_id=101 sau orice alt ID, și action=ViewProfile
		* Stage 4: Add Data Layer Access Control
			! Necesită Webgoat developer
			Din nou, necesită o simplă verificare !action.isAuthorizedForEmployee
	* Remote Admin Access
		- Se adaugă &admin=true la finalul URL-ului și se accesează Admin Functions

** AJAX Security ** == Face parte din BONUS
	* Same Origin Policy Protection
		- Am accesat link-ul cu request-ul google
	* LAB: DOM-Based cross-site scripting
		- Pasul 1: am introdus pur și simplu un tag img către
			images/logos/owasp.jpg în câmpul de nume
		- Pasul 2: am generat un JavaScript alert folosind tag-ul img prin
			adăugarea unui path inexistent și a unui handler de onerror de forma
			onerror=;;alert('MyXSSAlert')
		- Pasul 3: am generat același gen de alert folosind un tag iframe ce avea
			atributul src setat la valoarea "javascript:alert('MyIframeAlert');"
		- Pasul 4: Am folosit textul dat pentru a crea formularul fake
		- Pasul 5: Am editat fișierul js DOMXSS.js pentru a folosi
			escapeHTML(name) în loc de name simplu, pentru a evita atacul
	* LAB: Client Side Filtering
		- Pasul 1: Am accesat id-ul 112 pentru a afla salariul CEO-ului
		- Pasul 2: Am adăugat filtrul în XPath pentru fiecare câmp, pentru a nu
			permite accesul neautorizat:
			[Managers/Manager/text() = " + userId + "]
	* DOM Injection
		- Pur și simplu am modificat butonul din disabled in enabled
	* XML Injection
		- Am modificat XML-ul din răspuns pentru a conține și celelalte 2
			feature-uri
	* JSON Injection
		- Am modificat JSON-ul din respuns pentru a updata prețul zborului fără
			opriri la $100 în loc de $600
	* Silent Transactions Attacks
		- Am apelat javascript:submitData(1234567,123000); direct din browser
	* Dangerous Use of Eval
		- Am introdus 123');alert(document.cookie);(' în câmpul digit code,
			pentru a executa alert-ul, care este apelat de eval
	* Insecure Client Storage
		- Pasul 1: Debug în fișierul clientSideValidation.js, cu breakpoint pe
			linia decrypted = decrypt(coupons[i]);
			ceea ce ne dă numele cuponului 0 în clar "PLATINUM"
		- Pasul 2: Am șters readonly și am modificat valoarea câmpului grand
			total la $0.00

** Authentication Flaws **
	* Password Strenght
		- Am introdus valorile întoarse pentru fiecare parolă
	* Forgot Password
		- Am încercat pentru userul "admin" diverse culori. "green" a oferit
			parola
	* Basic Authentication
		- Câmpul Authorization, valoarea decodată "guest:guest"
		- Șters câmpul Authorization + modificat JSESSION
		- Modificat JSESSION la novalidsession
		
	* Multi Level Login 2
		- Pasul 1: User Jane, parola tarzan, TAN: 15648
		- Pasul 2: Modificat hidden_tan de la 2 la 1
	* Multi Level Login 1
		- Pasul 1: User Jane, parola tarza, TAN: 15648
		- Pasul 1: Modificat hidden_user la Jane

** Buffer Overflows **
	* Off-by-One Overflows
		- Pasul 1: Completare nume, prenume, iar la room un string foarte lung
		- Pasul 2: Interceptare request din partea a 2-a și modificat cu același
			string lung
		- Pasul 3: Logare cu unul din numele/camerele VIP proaspăt aflate

** Concurrency ** == Face parte din BONUS
	* Thread Safety Problems
		- Cum spun și instrucțiunile, log-in simultan în 2 ferestre cu cei doi
			useri, primesc aceeași informație în ambele părți datorită
			variabilei statice currentUser
	* Shopping Cart Concurrency Flaw
		- Într-o fereastră selectez un produs ieftin și dau să cumpăr, în altă
			fereastră selectez produsul scump și dau update cart, apoi în prima
			fereastră confirm, și am "primit" produsul scump la prețul mic

** Cross-Site Scripting (XSS) **
	* Phishing with XSS
		- Am încheiat form-ul precedent cu </form>, după care am inserat un
			script ce seta o imagine cu sursa dată de catcher, la adresa
			http://localhost/WebGoat/catcher?PROPERTY=yes&user= urmat de
			valoarea din formular urmat de &password= + valoarea din formular.
		- După script am inserat și formularul fals, care cerea user și parolă
			urmat de butonul submit care apela funcția definită anterior la
			submit
	* LAB: Cross Site Scripting
		* Stage 1: Stored XSS
			- Login cu userul Tom, update la profil, strada modificată cu un
				script ce conține un alert
			- Login cu userul Jerry și văzut alert când dat pe view profile la
				Tom
		* Stage 2: Block Stored XSS using Input Validation
			- Validare doar caractere ce conțin litere, cifre, underscore,
				virgulă sau cratimă
		* Stage 3: Stored XSS Revisited
			- Logat ca David, vizualizat profil Bruce, văzut efecte atac
		* Stage 4: Block Stored XSS using Output Encoding
			- înlocuire answer_results.getString(str) cu
				HtmlEncoder.encode(answer_results.getString(str))
		* Stage 5: Reflected XSS
			- Adăugat script în SearchStaff
		* Stage 6: Block Reflected XSS
			- Din nou, validare parametru în funcția getRequestParameter din
				FindProfile
	* Stored XSS Attacks
		- Introducere script cu alert în  câmpul message
		- Apoi introducere script cu alert(document.cookie) în același câmp
	* Reflected XSS Attacks
		- Script cu alert în câmpul PIN
	* Cross Site Request Forgery (CSRF)
		- Adăugat un tag img cu src ce pointează către un url cu parametrul GET
			transferFunds setat
	* CSRF Prompt By-Pass
		- La fel ca anterior, dar cu handler-ul onerror setat să ia o imagine
			de la același URL, dar cu parametrul transferFunds=CONFIRM
	* CSRF Token By-Pass
		- Un script care citește conținutul form-ului și ia valoarea CSRFToken
			și apoi apelează următorul script
		- Un al 2-lea script care face request GET cu parametrul transferFunds
		- Un iframe ce trimite pe transferFunds=main, și la onload apelează
			primul script, urmat de un alt iframe similar, fără src
	* HTTPOnly Test
		- Am setat HttpOnly în cookie-ul din request
	* Cross Site Tracing (XST) Attacks
		- Am introdus în câmpul pentru access code un script ce face o cerere
			HTTP TRACE

** Injection Flaws **
	* Command Injection
		- Am adăugat la sfârșitul parametrului HelpCommand șirul
			" & ipconfig , dar transformat în format URI: %22%20%26%20ipconfig
			pentru a executa comanda ipconfig
	* Numeric SQL Injection
		- Am adăugat șirul OR 1=1 la parametrul station din request. Aceasta
			face ca filtrul să se evalueze la TRUE întotdeauna.
	* Log Spoofing
		- Am introdus textul "Smith%0d%0aLogin Succeeded for username: admin"
			în câmpul de user name, care face ca în fișierul de log să fie scris
			carriage return și line feed, urmat de șirul Login Succeeded for
			username: admin, ce face sa pară că userul admin s-a logat. Acest
			comportament permite inserția de cod javascript malicios care să
			fie rulat când adminul va deschide logul browser.
	* XPATH Injection
		- În câmpul username am introdus șirul Smith' or 1=1 or 'a'='a
			care face ca serverul să evalueze la (username = 'Smith' or 1=1) OR
			('a'='a' and password='parola'), cu alte cuvinte să mă logheze ca
			primul utilizator din sistem
	* String SQL Injection
		- Similar cu cazul numeric, am introdus șirul Smith' OR '1'='1
			în acest caz, șirurile de caractere fiind necesar să fie terminate
			cu apostrof
	* LAB: SQL Injection
		* Stage 1: String SQL Injection
			- Am schimbat câmpul parolă cu ceva' OR '1' = '1 similar cu string
				injection
		* Stage 2: Parameterized Query #1
			- Câmpurile nume și parolă sunt parametrizate folosind '?'
		* Stage 3: Numeric SQL Injection
			- Interceptând ViewProfile am schimbat employee_id din 101 în
				101 OR 1=1 ORDER BY salary desc pentru a obține detaliile
				angajatului cu cel mai mare salariu, query-ul selectând doar
				primul rezultat
		* Stage 4: Parameterized Query #2
			- Similar cu partea #1, câmpul employer_id și employee_id sunt
				parametrizate folosind '?'
	* Modify Data with SQL Injection
		- Am folosit untext'; UPDATE salaries SET salary=999999 WHERE userid='jsmith
			pentru a modifica salariul lui jsmith
	* Add Data with SQL Injection
		- Am folosit untext'; INSERT INTO salaries VALUES ('unnume',123456);--
	* Database Backdoors
		- Pasul 1: am folosit stringul 101; update employee set salary=10000
			pentru a executa două query-uri
		- Pasul 2: Am folosit tehnica de la pasul 1 pentru a crea trigger-ul
	* Blind Numeric SQL Injection
		- Folosind un șir de forma
			101 AND ((SELECT pin FROM pins WHERE cc_number='1111222233334444') > 10000 );
			am putut găsi prin căutare binară pinul.
	* Blind String SQL Injection
		- Similar, folosind șiruri de forma
			101 AND (SUBSTRING((SELECT name FROM pins WHERE cc_number='4321432143214321'), 1, 1) < 'H' );
			am găsit că prima literă este J, a 2-a i, etc... Jill
** Denial of Service **
	* Denial of Service from Multiple Logins
		- Întâi am obtinut o listă cu utilizatorii prin introducerea string-ului
			' or '1' = '1 la câmpul parolei
		- Apoi pur și simplu m-am logat cu 3 utilizatori și am realizat astfel
			denial of servise

** Parameter Tampering **
	* Bypass HTML Field Restrictions
		- Am activt inputul dezactivat și am interceptat request-ul, modificând
			toate valorile inputurilor la caractere invalide precum ?/.<>:_-=+*&^%
	* Exploit Hidden Fields
		- Am modificat în request-ul interpceptat valoarea prețului.
	* Exploit Unchecked Email
		- Conținutul email-ului este de forma <script>alert("XSS")</script>
		- Am interceptat request-ul și am modificat și adresa "to"
	* Bypass Client Side JavaScript Validation
		- Am interceptat request-ul și am adăugat la finalul fiecărui câmp
			caractere invalide precum !@#

** Session Management Flaws **
	* Hijack a Session
		- Am interceptat request-ul și am văzut formatul WEAK-ID și prin forță
			brută l-am extras pe cel dorit
	* Spoof an Authentication Cookie
		- Am dedus care este formatul cookie-ului și m-am logat pe userul Alice
			folosind AuthCookie=65432fdjmb
	* Session Fixation
		- Pasul 1: Am append-uit &SID=1234 în url
		- Pasul 2: Click pe link
		- Pasul 3: Login cu user Jane parola tarzan
		- Pasul 4: Click pe link și modificat sid cu 1234

** Web Services ** == Face parte din BONUS
	* Create a SOAP Request
		- Am văzut că sunt 4 operații definite
		- getFirstNameRequest primește int
		- Am modificat request-ul să facă o cerere POST către SOAP
		- Am interceptat răspunsul pentru a afla că prenumele este Joe
	* WSDL Scanning
		- Am interceptat request-ul și am modificat parametrul în getCreditCard
	* Web Service SAX Injection
		- Am interceptat request-ul și am setat parametrul password la un string
			de forma:
					newpassword</password>
				</wsns1:changePassword>
				<wsns1:changePassword>
					  <id xsi:type='xsd:int'>102</id>
					<password xsi:type='xsd:string'>notforyoutoknow
	* Web Service SQL Injection
		- Folosind SOAPUi am cerut getCreditCard pentru toți userii, folosind
			id-ul 101 OR 1=1

P.S.: Dacă ai avut răbdare să citești toată polologhia asta, respect și-mi
datorezi o cola.