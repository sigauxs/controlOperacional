<!DOCTYPE html>
<html>

<head>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="//kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <style>

        .bg-brand {
           
    background-color: #EDEDED;

        }

        .brand_sigpe{
    max-width: 100px;
    padding: 10px;
}

.bg-brand{
    background-color:#EDEDED;
}

.bg-brand span i {
    padding: 10px;
    color: #A0A0A0;
}
        #dropzone {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            width: 800px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #progress-bar {
            width: 0%;
            height: 20px;
            background-color: #4CAF50;
            margin-bottom: 10px;
          
        }

        #output {
            margin-top: 20px;
        }

        #dropzone p {
            font-weight: 600;
            font-size: 25px;
        }

        .w-800{
            width: 800px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
   <div class="row">
     <div class="col-11 bg-brand">
       <a href="https://sigpeco.sigpeconsultores.com.co/menu.php">
        <img src="<?php
        if (isset($path)) { 
          echo $path.'assets/images/brand_icon.png';}
        else{
          echo 'assets/images/brand_icon.png';
        } ?>" 
        class="brand_sigpe img-brand" alt="sigpe consultores">
     </div></a> 
     <div class="col-1 bg-brand text-center">
     <a href="./menu.php"><button  style="border:0"><span><i class="fa-solid fa-arrow-right-from-bracket fa-2x"></i></span></button></a>
     </div>
   </div>
  </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-5">
                    <div id="dropzone">
                       <p>Arrestre y suelte las imagenes aqui.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <h4 class="my-3">O</h4>
                </div>
                <div class="d-flex justify-content-center">
                 <label class="btn btn-danger" for="uploadImagenes">Pulse aqui para adjuntar imagenes</label>  <input accept="image/png,image/jpeg" style='display:none' type="file" name="uploadImagenes" id="uploadImagenes" multiple>
                </div>

                <div class="d-flex justify-content-center">
                    
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <div id="progress-bar" class="progress-bar progress-bar-striped bg-danger"></div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-9">
                             <h3>Listado de imagenes comprimidas</h3>   
                        </div>
                        <div class="col-md-3 text-center">
                        <button id="limpiar" class="btn btn-danger">Limpiar lista</button>
                        </div>
                  
                    </div>
                    
                </div>
                <div id="output"></div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

        const limpiar = document.getElementById("limpiar");
        const cerrarpestana = document.getElementById("cerrarPestana");
        const uploadImagenes = document.getElementById("uploadImagenes");


        uploadImagenes.addEventListener("change",()=>{


          


            

            event.preventDefault();

            let allowedExtensions = /(.jpg|.jpeg|.png)$/i;
            let filePath = uploadImagenes.value;

            const files = uploadImagenes.files;
            const totalFiles = files.length;
            let   processedFiles = 0;
            let   filesNombres = [];

            if (!allowedExtensions.exec(filePath)) {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Tipo de archivo no admitido',
          showConfirmButton: false,
          timer: 2000
        })


        uploadImagenes.value = '';
        return false;
      }



// Iterate over each file
Array.from(files).forEach((file, index) => {
    const reader = new FileReader();

    reader.onload = (event) => {
        const image = new Image();
        image.src = event.target.result;

        image.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            // Set the maximum width and height for the image
            const maxWidth = 800;
            const maxHeight = 800;

            // Calculate the new dimensions while maintaining aspect ratio
            let width = image.width;
            let height = image.height;
            if (width > maxWidth || height > maxHeight) {
                if (width > height) {
                    height *= maxWidth / width;
                    width = maxWidth;
                } else {
                    width *= maxHeight / height;
                    height = maxHeight;
                }
            }

            // Set the canvas dimensions to the new dimensions
            canvas.width = width;
            canvas.height = height;

            // Draw the image on the canvas
            ctx.drawImage(image, 0, 0, width, height);

            // Reduce image size
            canvas.toBlob((blob) => {
                showDownloadButton(file.name, blob, index + 1);
                processedFiles++;
                const progress = Math.round((processedFiles / totalFiles) * 100);
                updateProgressBar(progress);

                if (processedFiles === totalFiles) {
                    // All files have been processed
                    // Clean up drag and drop listeners
                    document.removeEventListener('dragover', handleDragOver);
                    document.removeEventListener('drop', handleDrop);
                }
            }, 'image/jpeg', 1.0); // Adjust compression quality here (0.0 - 1.0)
        };
    };

    reader.readAsDataURL(file);
});




        })

        function updateProgressBar(progress) {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = `${progress}%`;
        }

        // Helper function to display the compressed image download button
        function showDownloadButton(nombre, imageBlob, index) {

            let nombreImagen = "";

               if(nombre.includes(".png")){
                    console.log(nombre.includes(".png"))
                    nombreImagen = nombre.replace(".png","")
                }

                if(nombre.includes(".jpg")){
                    console.log(nombre.includes(".jpg"))
                    nombreImagen = nombre.replace(".jpg","")
                }

                if(nombre.includes(".jpeg")){
                    console.log(nombre.includes(".jpeg"))
                    nombreImagen = nombre.replace(".jpeg","")
                }


            const output = document.getElementById('output');

            const downloadButton = document.createElement('a');
            downloadButton.href = URL.createObjectURL(imageBlob);
            downloadButton.setAttribute("class","btn btn-danger mb-3 mx-3");
            downloadButton.download = `${nombreImagen}.jpg`;
            downloadButton.innerText = `${nombreImagen} ${index}`;

            output.appendChild(downloadButton);
            output.appendChild(document.createElement('br'));
        }


        limpiar.addEventListener("click",()=>{

            location.reload();
        });

   
        // Handle file drop event
        function handleDrop(event) {
            event.preventDefault();

            const files = event.dataTransfer.files;
            const totalFiles = files.length;
            let processedFiles = 0;
            let filesNombres = [];

            // Iterate over each file
            Array.from(files).forEach((file, index) => {




                const reader = new FileReader();

                reader.onload = (event) => {
                    const image = new Image();
                    image.src = event.target.result;

                    image.onload = () => {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        // Set the maximum width and height for the image
                        const maxWidth = 800;
                        const maxHeight = 800;

                        // Calculate the new dimensions while maintaining aspect ratio
                        let width = image.width;
                        let height = image.height;
                        if (width > maxWidth || height > maxHeight) {
                            if (width > height) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            } else {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        // Set the canvas dimensions to the new dimensions
                        canvas.width = width;
                        canvas.height = height;

                        // Draw the image on the canvas
                        ctx.drawImage(image, 0, 0, width, height);

                        // Reduce image size
                        canvas.toBlob((blob) => {
                            showDownloadButton(file.name.replace(".jpg", ""), blob, index + 1);
                            processedFiles++;
                            const progress = Math.round((processedFiles / totalFiles) * 100);
                            updateProgressBar(progress);

                            if (processedFiles === totalFiles) {
                                // All files have been processed
                                // Clean up drag and drop listeners
                                document.removeEventListener('dragover', handleDragOver);
                                document.removeEventListener('drop', handleDrop);
                            }
                        }, 'image/jpeg', 0.9); // Adjust compression quality here (0.0 - 1.0)
                    };
                };

                reader.readAsDataURL(file);
            });
        }

        // Handle drag over event
        function handleDragOver(event) {
            event.preventDefault();
        }

        // Add drag and drop listeners
        const dropzone = document.getElementById('dropzone');
        dropzone.addEventListener('dragover', handleDragOver);
        dropzone.addEventListener('drop', handleDrop);
    </script>

</body>

</html>