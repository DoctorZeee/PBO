Perbedaan ARRAY dengan COLLECTION :

ARRAY (Built-in PHP):
  - Struktur data bawaan PHP yang fleksibel
  - Bisa menyimpan berbagai tipe data
  - Tidak ada interface yang jelas
  - Tidak ada enkapsulasi, langsung akses elemen
  - Tidak ada type safety
  - Contoh: $arr = [1, 2, 3]; $arr[0] = "text";
  
  COLLECTION (ARRAY dengan implementasi OOP):
  - Objek yang membungkus array dengan behavior tertentu
  - Punya interface
  - Ada enkapsulasi dan kontrol akses
  - Ada validasi dan type safety
  - Lebih maintainable dan testable
  - Mendukung polymorphism
  - Contoh: $list = new ArrayList(); $list->add(1);

Jadi kesimpulannya ARRAY adalah struktur data bawaan yang dapat langsung dipanggil tanpa harus membuat objek terlebih dahulu namun di array ini manipulasi datanya masih terbatas dan tidak ada type saftey dan kontrol data yang terbatas juga.
Sedangkan, untuk Collection sendiri itu adalah bentuk enkapsulasi dari sebuah array dinamis dimana kita harus membuat method untuk mengakses ada kontrol data yang pasti terdapat type safety juga dan karena collection ini bentuknya objek maka
collection mendukung polymorphism sehingga dapat mengurangi pengulangan kode atau reusable.
