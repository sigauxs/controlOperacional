<!DOCTYPE html>
<html>

<head>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-5">
                    <div id="dropzone">
                       <p>Arrestre y suelte la imagen aqui.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <div id="progress-bar"></div>
                </div>
                
                <div id="output"></div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function updateProgressBar(progress) {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = `${progress}%`;
        }

        // Helper function to display the compressed image download button
        function showDownloadButton(nombre, imageBlob, index) {
            const output = document.getElementById('output');

            const downloadButton = document.createElement('a');
            downloadButton.href = URL.createObjectURL(imageBlob);
            downloadButton.download = `${nombre}_${index}.jpg`;
            downloadButton.innerText = `${nombre} ${index}`;

            output.appendChild(downloadButton);
            output.appendChild(document.createElement('br'));
        }

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
                        }, 'image/jpeg', 0.7); // Adjust compression quality here (0.0 - 1.0)
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

    <script>
        /*
        function updateProgressBar(progress) {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = `${progress}%`;
        }

    
        function showDownloadButton(imageBlob, index) {
            const output = document.getElementById('output');
            const image = URL.createObjectURL(imageBlob);
            
            const downloadButton = document.createElement('a');
            downloadButton.href = image;
            downloadButton.download = `compressed_image_${index}.jpg`;
            downloadButton.innerText = `Download Image ${index}`;
            
            output.appendChild(downloadButton);
            output.appendChild(document.createElement('br'));
        }

        function handleDrop(event) {
            event.preventDefault();
            
            const files = event.dataTransfer.files;

            const totalFiles = files.length;
            let processedFiles = 0;

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = (event) => {
                    const image = new Image();
                    image.src = event.target.result;

                    image.onload = () => {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                       
                        canvas.width = image.width;
                        canvas.height = image.height;

                     
                        ctx.drawImage(image, 0, 0);

                    
                        canvas.toBlob((blob) => {
                            showDownloadButton(blob, index + 1);
                            processedFiles++;
                            const progress = Math.round((processedFiles / totalFiles) * 100);
                            updateProgressBar(progress);

                            if (processedFiles === totalFiles) {
                       
                                document.removeEventListener('dragover', handleDragOver);
                                document.removeEventListener('drop', handleDrop);
                            }
                        }, 'image/jpeg', 0.7); 
                    };
                };

                reader.readAsDataURL(file);
            });
        }

     
        function handleDragOver(event) {
            event.preventDefault();
        }

        const dropzone = document.getElementById('dropzone');
        dropzone.addEventListener('dragover', handleDragOver);
        dropzone.addEventListener('drop', handleDrop);*/
    </script>
</body>

</html>