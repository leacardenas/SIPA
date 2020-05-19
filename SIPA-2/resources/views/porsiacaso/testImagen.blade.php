<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
      @csrf
	         <input type="file" name="imagen" />
	         <input type="submit"/>

            <br/><br/><br/>
            <img src="<?php echo "../..//archivosDelSistema/activos/imagenes/" . "May192020_1589868780_Comparacion.jpg" ?>" height="100" width="100">
      </form>

   </body>
</html>