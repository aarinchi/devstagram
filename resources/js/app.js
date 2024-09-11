
import Dropzone from "dropzone";

//Vamos a defenir nuestra propia ruta para las peticiones

Dropzone.autoDiscover = false;

//Crear el objeto de Dropzone
const dropzone = new Dropzone('#dropzone',{ //Toma como valor en donde va a air el dropzone y valores extras
    dictDefaultMessage: 'Sube aqui tu imagen', //Mensaje por defecto
    acceptedFiles: ".png, .jpg, .jpeg, .gif", //TIpo de formatos aceptados
    addRemoveLinks: true, //Permitir eliminar la imagen antes de subirla
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1, //Cuantas imagenes por subida
    uploadMultiple: false,

    //Una vez creado el objeto de dropzone
    init:function(){
        //Agregamos la imagen previa para no perder la referencia de la imagen
        if(document.querySelector('[name="imagen"]').value.trim()){ //Si existe un valor dentro de ese input quiere decir que se agrego una imagen

            const nombreImagen = document.querySelector('[name="imagen"]').value;

            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = nombreImagen;

            //Aqui asignamos nuestro arreglo al objeto de dropzone
            this.options.addedfile.call(this, imagenPublicada);
            //Si ya existe una imagen en el dropzone mantenemos su miniatura
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

            //Agregamos unas clases de dropzone 
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");

            console.log(imagenPublicada);

        }
    }

});

//Acciones de DropZone 

//Envio de la Imagen con exito entonces
dropzone.on("success", function(file, response){ 

    //Vamos a agregar el nombre de la imagen del dropzone al input hidden
    document.querySelector('[name="imagen"]').value = response.imagen;
});

//Cueando se remueva la imagen hay que limpiar el input oculto
dropzone.on("removedfile", function(){
    document.querySelector('[name="imagen"]').value = "";
})