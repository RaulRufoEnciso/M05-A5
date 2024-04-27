<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="container mt-5 w-80">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Formulari</h2>

            <form id="productForm" method="POST">
                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="nomProducte" name="nomProducte" placeholder="Nom" value="">
                </div>
                
                <input type="hidden" name="addEdit" id="addEdit" value="0"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> 
        </div>
        <div class="col">
            <h2 class="mb-3">Llistat</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                
                <tbody id="productList">
                    <!-- Aquí se mostrarán los productos -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para cargar la lista de productos
            function loadProductList() {
                fetch('getProducte.php')
                .then(response => response.json())
                .then(data => {
                    const productList = document.getElementById('productList');
                    productList.innerHTML = ''; // Limpiamos la lista antes de agregar los productos

                    data.forEach(product => {
                        const row = `
                            <tr>
                                <th scope="row">${product.id}</th>
                                <td>${product.nom}</td>
                                <td><button class="btnEdit btn btn-outline-info" idProd="${product.id}">Edit</button></td>
                                <td><button class="btn btn-outline-danger">Remove</button></td>
                            </tr>
                        `;
                        productList.innerHTML += row;
                    });

                    // Event listener para el botón de Edit
                    const btnEdit = document.querySelectorAll('.btnEdit');
                    btnEdit.forEach(btn => {
                        btn.addEventListener('click', function() {
                            const productId = this.getAttribute('idProd');
                            fetch(`getProducte.php?id=${productId}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('nomProducte').value = data.nom;
                                document.getElementById('addEdit').value = data.addEdit;
                            })
                            .catch(error => console.error('Error:', error));
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
            }

            // Cargar la lista de productos al cargar la página
            loadProductList();

            // Event listener para el formulario de producto
            document.getElementById('productForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe por método tradicional

                const formData = new FormData(this);

                fetch('ex2AddEdit.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Muestra la respuesta del servidor en la consola
                    loadProductList(); // Recargar la lista de productos después de agregar/editar
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
