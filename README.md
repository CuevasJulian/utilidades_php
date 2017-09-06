# utilidades_php
pequeños componentes que desarrollare para facilitar algunas funciones en php

getInfoWeb.php
--------------------
**Type:** POST  
**NO CONTENT TYPE**  
**Data:** {"url":"http://suarticuloaqui.com"}  

Esta utilidad sirve para descargar el contenido de la web a manera de preview, es decir, a traves de un ajax, o un xmlhttprequest
de javascript puedes enviarle una *url* que el php respondera con un json con 3 keys adentro.

**1) titulo**: es un array de 1 o mas textos (string) correspondiente a los elementos h1,h2 y h3 de la web indicada en *url* 

**2) descripcion**: corresponde al meta description de la url que indicaste

**3) imagen**: es un array de 1 o mas urls encontrados en los *src* de los tags img encontrados dentro de las **url** que indicaste


**EJEMPLO**

*AJAX REQUEST*

> $.ajax({  
>   url:"getInfoWeb.php", // direccion de getInfoWeb.php en tu computador  
>   type:"POST",  
>   data:{"url":"www.algo.com"},  
>   success:function(result){    
>   //aqui recibes el json con **titulo**(array), **descripcion**(string), **imagen**(array)  
>   }
> });

#### URL EJEMPLO: https://www.reuters.com/article/us-usa-pesticides-epa-exclusive/exclusive-epa-eyes-limits-for-agricultural-chemical-linked-to-crop-damage-idUSKCN1BG1GT

#### RESPUESTA:  
> {"titulo":["Exclusive: EPA eyes limits for agricultural chemical linked to crop damage","RISKY DRIFT  "],"descripcion":"The U.S. environmental agency is considering banning sprayings of the agricultural herbicide dicamba after a set deadline next year, according to state officials advising the agency on its response to crop damage linked to the weed killer.","imagen":["https:\/\/cdn.distiltag.com\/api\/v1\/defense\/noscript\/jbGgBzARE9bHOhVUFTu6qTSnLIHlhKsqB3zjEme8","https:\/\/s2.reutersmedia.net\/resources\/r\/?m=02&d=20170905&t=2&i=1200024631&w=&fh=545px&fw=&ll=&pl=&sq=&r=LYNXNPED840ZC","https:\/\/s2.reutersmedia.net\/resources\/r\/?m=02&d=20170905&t=2&i=1200024631&w=&fh=545px&fw=&ll=&pl=&sq=&r=LYNXNPED840ZC"]}
