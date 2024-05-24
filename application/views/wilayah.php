<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Wilayah Indonesia</title>
</head>
<body>

  <form id="wilayahForm">
    <label for="provinsi">Provinsi:</label>
    <select id="provinsi" onchange="populateKabupaten()">
      <!-- Pilihan Provinsi akan diisi secara dinamis dari API -->
    </select>

    <br>

    <label for="kabupaten">Kabupaten/Kota:</label>
    <select id="kabupaten" onchange="populateKecamatan()" disabled>
      <option value=''>Pilih Kabupaten/Kota</option>
    </select>

    <br>

    <label for="kecamatan">Kecamatan:</label>
    <select id="kecamatan" onchange="populateKelurahan()" disabled>
      <option value=''>Pilih Kecamatan</option>
    </select>

    <br>

    <label for="kelurahan">Kelurahan:</label>
    <select id="kelurahan"  onchange="populateAlamat()" disabled>
      <option value=''>Pilih Kelurahan</option>
    </select>

    <br>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" disabled>
    
  </form>

  <script>
//API Wilayah
fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
          .then(response => response.json())
          .then(provinces => {
            var data = provinces;
            var tampung = '<option value="">Pilih Provinsi</option>';
            data.forEach(element => {
              tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
            });
            document.getElementById('provinsi').innerHTML = tampung;
          })

        function populateKabupaten() {
          var provinsi = document.getElementById('provinsi').value;

          // Menonaktifkan dropdown kabupaten
          document.getElementById('kabupaten').disabled = true;

          // Menonaktifkan dropdown kecamatan
          document.getElementById('kecamatan').disabled = true;

          // Menonaktifkan input kelurahan
          document.getElementById('kelurahan').disabled = true;

          // Menonaktifkan input alamat
          document.getElementById('alamat').disabled = true;

          if (provinsi) {
            var region = document.querySelector(`#provinsi option[value="${provinsi}"]`).dataset.region;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${region}.json`)
              .then(response => response.json())
              .then(regencies => {
                var data = regencies;
                var tampung = '<option value="">Pilih Kabupaten/Kota</option>';
                data.forEach(element => {
                  tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kabupaten').innerHTML = tampung;

                // Mengaktifkan dropdown kabupaten
                document.getElementById('kabupaten').disabled = false;
              })
          }
        }

        function populateKecamatan() {
                var kabupaten = document.getElementById('kabupaten').value;

                // Menonaktifkan dropdown kecamatan
                document.getElementById('kecamatan').disabled = true;

                // Menonaktifkan input kelurahan
                document.getElementById('kelurahan').disabled = true;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (kabupaten) {
                  var region = document.querySelector(`#kabupaten option[value="${kabupaten}"]`).dataset.region;
                  fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${region}.json`)
                    .then(response => response.json())
                    .then(districts => {
                      var data = districts;
                      var tampung = '<option value="">Pilih Kecamatan</option>';
                      data.forEach(element => {
                        tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
                      });
                      document.getElementById('kecamatan').innerHTML = tampung;

                      // Mengaktifkan dropdown kecamatan
                      document.getElementById('kecamatan').disabled = false;
                    })
                }
              }

              function populateKelurahan() {
                var kecamatan = document.getElementById('kecamatan').value;

                // Menonaktifkan input kelurahan
                document.getElementById('kelurahan').disabled = true;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (kecamatan) {
                  var region = document.querySelector(`#kecamatan option[value="${kecamatan}"]`).dataset.region;
                  fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${region}.json`)
                    .then(response => response.json())
                    .then(villages => {
                      var data = villages;
                      var tampung = '<option value="">Pilih Kelurahan/Desa</option>';
                      data.forEach(element => {
                        tampung += `<option value="${element.name}">${element.name}</option>`;
                      });
                      document.getElementById('kelurahan').innerHTML = tampung;

                      // Mengaktifkan input alamat
                      document.getElementById('kelurahan').disabled = false;
                    })
                }
              }
              
              function populateAlamat() {
                var kelurahan = document.getElementById('kelurahan').value;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (alamat) {
                  // Mengaktifkan input alamat
                  document.getElementById('alamat').disabled = false;
                }

                }
  </script>

</body>
</html>
