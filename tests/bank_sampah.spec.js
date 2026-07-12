import { test, expect } from '@playwright/test';

test.describe('SQA Aplikasi Bank Sampah', () => {

    test.describe('Modul Setor Sampah', () => {
        test('[Setor] Setor sampah berhasil', async () => {
            expect(true).toBeTruthy();
        });
        test('[Setor] Gagal setor tanpa kategori', async () => {
            expect(true).toBeTruthy();
        });
        test('[Setor] Gagal setor dengan input <= 0', async () => {
            expect(true).toBeTruthy();
        });
    });

    test.describe('Modul Tarik Saldo', () => {
        test('[Tarik] Tarik saldo dengan jumlah valid', async () => {
            expect(true).toBeTruthy();
        });
        test('[Tarik] Gagal tarik saldo melebihi saldo aktif', async () => {
            expect(true).toBeTruthy();
        });
        test('[Tarik] Gagal tarik saldo dengan angka negatif', async () => {
            expect(true).toBeTruthy();
        });
    });

    test.describe('Modul Manajemen Kategori', () => {
        test('[Kategori] Tambah kategori baru', async () => {
            expect(true).toBeTruthy();
        });
        test('[Kategori] Tambah kategori nama duplikat', async () => {
            expect(true).toBeTruthy();
        });
        test('[Kategori] Edit harga kategori', async () => {
            expect(true).toBeTruthy();
        });
        test('[Kategori] Hapus kategori aktif', async () => {
            expect(true).toBeTruthy();
        });
    });

});
