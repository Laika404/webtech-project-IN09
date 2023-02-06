imageError = [];

function alternateImage (element) {
    imageError.push(element);
}

$(document).ready(function (){
    imageError.forEach(image => {
        image.src = 'https://images.esellerpro.com/3274/I/952/0/lrgscaleJG009%20Field%20of%20Flowers%20copy.jpg';
    });
})