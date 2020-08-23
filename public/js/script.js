$(function () {
    // JQUERY CARIKAN TOMBOL TAMBAH KETIKA DI CLICK
    $('.tombolTambahData').on('click', function () {
        // UBAH HTML PADA MODAL LABEL
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        // UBAH HTML PADA BUTTON DI MODAL FOOTER
        $('.modal-footer button[type=submit]').html('Tambah Data');
        // HAPUS VALUE MENJADI KOSONG / RESET
        // $('nama').val("");
        // $('npm').val("");
        // $('email').val("");
        // $('fakultas').val("");
        // $('id').val("");
        $('.modal-body form')[0].reset();
    });

    // JQUERY CARIKAN TOMBOL UBAH KETIKA DI CLICK
    $('.tampilModalUbah').on('click', function () {
        // UBAH HTML PADA MODAL LABEL
        $('#formModalLabel').html('Ubah Data Mahasiswa');
        // UBAH HTML PADA BUTTON DI MODAL FOOTER
        $('.modal-footer button[type=submit]').html('Ubah Data');
        // UBAH ATRIBUT PADA FORM DI MODAL BODY
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');

        // BUAT VAR, AMBIL ID DARI TOMBOL YANG KITA CLICK (THIS)
        const id = $(this).data('id');

        // AJAX = METHOD PADA JQUERY
        // AJAX BERUPA OBJEK JADI TAMBAHKAN KURUNG KURAWAL
        $.ajax({
            // AMBIL DATA KE URL MANA / MENJALANKAN METHOD GET UBAH
            url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
            // KIRIMKAN DATA 
            data: {
                // ID (NAMA DATA) : ID (ISI DATA)
                id: id
            },
            // KIRIMKAN DATA MENGGUNAKAN METHOD POST
            method: 'post',
            // TIPE DATA 1. JSON 2. TEXT BIASA
            dataType: 'json',
            // JIKA PERMINTAAN BRHASIL JALANKAN FUNGSI
            success: function (data) {
                // JQUERY CARIKAN SAYA ID (ID)
                // AMBIL VALUE YANG BERISIKAN OBJEK (DATA) PANGGIL PROPERTY (ID)
                $('#id').val(data.id); // php: data->id
                $('#nama').val(data.nama);
                $('#npm').val(data.npm);
                $('#email').val(data.email);
                $('#fakultas').val(data.fakultas);
            }
        });
    });

});