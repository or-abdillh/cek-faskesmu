<style scoped>
.btn {
    @apply block px-5 py-2 rounded-full;
}
</style>

<template>
    <!-- hapus faskes -->
    <section class="mb-4 flex justify-between items-center">
        <section class="md:w-9/12">
            <strong class="text-gray-700">Fasilitas Kesehatan</strong>
            <p class="text-gray-600 mb-2">
                Dengan menekan tombol ini, semua data terkait dengan fasilitas akan dihapus, seperti seluruh layanan dan
                obatan yang sudah ada dan
                peran
                pengguna akan dikembalikan
                menjadi pengguna biasa.</p>
        </section>
        <span>
            <button class="btn bg-red-500 text-gray-100">Hapus Fasilitas</button>
        </span>
    </section>

    <!-- hapus faskes -->
    <section class="mb-4 flex justify-between items-center">
        <section class="md:w-9/12">
            <strong class="text-gray-700">Layanan atau Obatan</strong>
            <p class="text-gray-600 mb-2">
                Menghapus semua data layanan pada fasilitas beserta data yang terkait, seperti ulasan
                dan rating para pengguna lainnya serta data para pengguna yang menyimpan beberapa layanan atau obatan pada
                faskes ini
                pada akun mereka
            </p>
        </section>
        <span class="flex flex-col gap-2">
            <button class="btn bg-red-500 text-gray-100">Reset Layanan</button>
            <button class="btn bg-red-500 text-gray-100">Reset Obatan</button>
        </span>
    </section>
</template>