<!DOCTYPE html>
<html>
<head>
  <title>Proyecto final fisica</title>
 <link rel="stylesheet" href="style.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script type="text/javascript">
    window.onload = function() {
      var anguloInput = document.getElementById('angulo');
      
      anguloInput.addEventListener('change', function() {
        var angulo = parseInt(anguloInput.value);
        
        if (angulo >180) {
          alert('El ángulo no puede ser mayor a 180');
        }
      });
    };
  </script>
 </head>
<body>
 
    <div class="proyecto"> 
        
        <div class="inicio">
            <header >
            <h1>  TRAYECTORIA DE UN PROYECTIL </h1>
            </header>
        </div>

        <nav class="navbar">
            <a href="#">inicio</a>
            <a href="#definicion">Definicion </a>
            <a href="#ejemplos">Ejemplo</a>
            <a href="#grafico">Grafico</a>
            <a href="page1.html">Formulas </a>
            <a href="ad.html">Tiempo Lanzamiento </a>
        </nav>
    </div>

    
        <h2 class="title" id="definicion"> DEFINICION </h2>
        <div class="texto">
            <h3>
                Es la ruta que un cuerpo sigue cuando a sido lanzado, y puede ser representada
                en un sistema coordinado, este se lanza con una velocidad inicial la cual tiene dos
                componentes (Horizontal (eje x) Vertical (eje y)) en donde el eje X no se ve afectada por la gravedad
                mientras que la del eje y se mira influenciada por la aceleracion debida a la gravedad. 

            </h3>
        </div>

    <section class="ejemplo">

        <div class="texto">
            <h4>El eje Horizontal X representa la distancia que el objeto viaja (En direccion de X)
                y el eje vertical representa la altura (En direccion del eje y) del tiro.
                Es importante tener en cuenta que el proyectil asciende en el aire devido a su velocidad
                vertical inicial y a medida que este asciende su velocidad disminuye debido a la influencia de la gravedad. </h4>
        </div>

        <div class="box-container" id="ejemplos">

            <div class="box">
              <img class="imagenes" src="imagenes/piedra.jpg" height="200px" width="70%" alt="">
                <h3> 1 </h3>
                <p class="texto2"> Lanzamiento de una piedra </p>

            </div>
            <div class="box">
                <img class="imagenes" src="imagenes/motocicleta.jpg" height="200px" width="70%"alt="">
                <h3>2</h3>
                <p class="texto2"> Salto de una Motocicleta </p>

            </div>
            <div class="box">
                <img class="imagenes" src="imagenes/beisbol.jpg" height="200px" width="70%"alt="">
                <h3>3</h3>
                <p class="texto2"> Bateo de una pelota de beisbol </p>

            </div>

        </div> 
   
</section class = "Grafico">
<td> 
    <h2 class="title" id="grafico"> GRAFICO </h2>
<h3 class="texto">A continuacion podras digitar los valores que desees y generar tu propio proyectil.  </h3> 

</section class = "Variables">

<tr> <td> 
    
    <table> 
        <div class="Variables">
        <form action="resultado.php" target="resultado">
        <tr> <td> <label class="datos" for="velocidad" >Velocidad:</label></td>
        <td><input type="number" id="velocidad" name="velocidad" step="any" required> </td></tr>
        <tr> <td> <label class="datos" for="gravedad"> Gravedad: </label></td>
        <td> <input type="number" id="gravedad" name="gravedad" step="any"> </td></tr>
        <tr><td> <label class="datos" for="angulo">Ángulo:</label> </td>
        <td> <input type="number" id="angulo" name="angulo" step="any" required ></td></tr>
        <td><label class="datos" for="tiempo">Tiempo:</label></td>
        <td> <input type="number" id="tiempo" name="tiempo" step="any"></td>
        </div>

        <tr><td> <input class="boton" type="submit" value="Guardar"  height="50" step="any"></td></tr> 
    
    </table>
    </td>
</div>
</form>

</td> 

  <iframe class="espacioGrafico" name= "resultado" src="" width="900" height="600"></iframe>

</td> </tr> 
    </table>

    <div class = "class-home"> 
        <a href="#" class = "btn"> <h2>Volver al inicio</h2></a>

    </div>
   
    <h3 class="nombres"> Presentado por: Maria Casanova, Sofia Burbano, Juan Calpa, Cristhian Padilla, Alejandro Portilla </h3>
    
</body>
</html>
