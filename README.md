upAjax
======

Kleines Plug-In zum einfachen datenaustausch zwischen dem Client und dem Server.
In der PHP werden die Funktionen registriert die per JavaScript aufgerufen werden können.

### PHP Seitig 
######-----------------------------------------------------------------------------------------------------------
upAjax Klasse einbinden
```php
require_once('class/upAjax.php');

// Funktion die übers JavaScript aufgerufen werden soll
function helloWorld($argONe,$argTwo,$argThree) {

    echo 'Hello WORLD';
    print_r($argONe);
    echo $argTwo;
    echo $argThree;
}

// Funktion die übers JavaScript aufgerufen werden soll
function getForm($form){
    global $upAjax;
    echo 'Form Data incoming';

    echo $form['key1'].'\n';
    echo $form['key2'];

    $upAjax->sendArray($form);
}

$upAjax = new upAjax();
// Funktionen registrieren die per JavaScript aufgerufen werden können
$upAjax->regFunction('helloWorld');
$upAjax->regFunction('getForm');
```

### Javascript Seitig
######-----------------------------------------------------------------------------------------------------------

FormData verschicken

```javascript
// Objekt erzeugen
var ajax = new XMLHttpRequest();

// Rückgabewert von Server verarbeiten
ajax.onloadend = function(e){
  console.log(this.response);
};

// Funktionsname in der PHP die aufgerufen werden soll
ajax.setTargetFunctionName('getForm');

// FormData erzeugen und Daten anlegen
var formData = new FormData();
formData.append('key1', 'value1');
formData.append('key2', 'value2');

// FormData übergeben
ajax.setFormData(formData);

// Daten verschicken an Ziel Datei
ajax.sendFormData("index.php");
```
Rückgabewert:
"Form Data incomingvalue1\nvalue2{"key1":"value1","key2":"value2"}"

### Eigene Parametern übergeben 
```javascript
// Objekt erzeugen
var ajax = new XMLHttpRequest();

// Rückgabewert von Server verarbeiten
ajax.onloadend = function(e){
  console.log(this.response);
};

// Funktionsname in der PHP die aufgerufen werden soll
ajax.setTargetFunctionName('helloWorld');

// die übergeben Parametern der Funktion
ajax.setParameter({1:'test'});
ajax.setParameter('test');
ajax.setParameter('test2');

// Daten verschicken an Ziel Datei
ajax.sendData("index.php");

```
Rückgabewert:
"Hello WORLDArray
(
    [1] => test
)
testtest2"
