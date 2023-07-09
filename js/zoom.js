function showImage(imageUrl) {
    var overlay = document.querySelector('.overlay');
    var zoomedImage = document.querySelector('#zoomedImage');

    zoomedImage.src = imageUrl;
    overlay.style.display = 'flex';
}

function hideImage() {
    var overlay = document.querySelector('.overlay');
    overlay.style.display = 'none';
}