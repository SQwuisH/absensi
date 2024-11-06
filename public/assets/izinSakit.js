Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90,
    flip_horiz: false // Nonaktifkan mirroring kamera
});
Webcam.attach('#my_camera'); // Menampilkan kamera di div dengan id 'my_camera'



// Fungsi untuk mengambil gambar
function ambilFoto() {
    Webcam.snap(function (data_uri) {
        // Simpan gambar dalam variabel image
        let image = data_uri;

        // Tampilkan gambar di elemen <img> dengan id 'result'
        document.getElementById('result').src = data_uri;
        document.getElementById('result').style.display = 'block';

        // Simpan data image dalam input tersembunyi untuk dikirim ke server
        document.getElementById('photo_webcam').value = image;

        // Sembunyikan tampilan kamera
        document.getElementById('my_camera').style.display = 'none';
    });
}

// Fungsi untuk mengulang mengambil foto
function ambilUlang() {
    // Reset gambar dan tampilkan kembali kamera
    document.getElementById('result').style.display = 'none';
    document.getElementById('my_camera').style.display = 'block';
}
