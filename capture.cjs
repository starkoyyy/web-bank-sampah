const { chromium } = require('playwright');
const fs = require('fs');

(async () => {
  if (!fs.existsSync('screenshots')) {
    fs.mkdirSync('screenshots');
  }

  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext();
  const page = await context.newPage();

  console.log('Capturing Login...');
  try {
      await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'domcontentloaded', timeout: 10000 });
      await page.screenshot({ path: 'screenshots/0_login.png' });
  } catch(e) { console.log('Error Login', e.message); }

  console.log('Capturing Register...');
  try {
      await page.goto('http://127.0.0.1:8000/register', { waitUntil: 'domcontentloaded', timeout: 10000 });
      await page.screenshot({ path: 'screenshots/1_register.png' });
  } catch(e) { console.log('Error Register', e.message); }

  console.log('Login as Admin...');
  try {
      await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'domcontentloaded' });
      await page.fill('input[name="username"]', 'admin');
      await page.fill('input[name="password"]', 'admin123');
      await page.click('button[type="submit"]');
      await page.waitForTimeout(2000); // Wait for redirect
      await page.screenshot({ path: 'screenshots/2_admin_dashboard.png' });
  } catch(e) { console.log('Error Admin Login', e.message); }

  console.log('Capturing Kategori...');
  try {
      await page.goto('http://127.0.0.1:8000/admin/kategori', { waitUntil: 'domcontentloaded', timeout: 10000 });
      await page.screenshot({ path: 'screenshots/3_kategori.png' });
  } catch(e) { console.log('Error Kategori', e.message); }

  // Now login as Nasabah
  const context2 = await browser.newContext();
  const page2 = await context2.newPage();
  console.log('Login as Nasabah...');
  try {
      await page2.goto('http://127.0.0.1:8000/login', { waitUntil: 'domcontentloaded' });
      await page2.fill('input[name="username"]', 'rifqy');
      await page2.fill('input[name="password"]', 'password'); // Assume 'password' or we just try
      await page2.click('button[type="submit"]');
      await page2.waitForTimeout(2000);
      await page2.screenshot({ path: 'screenshots/4_nasabah_dashboard.png' });
  } catch(e) { console.log('Error Nasabah Login', e.message); }

  console.log('Capturing Setor...');
  try {
      await page2.goto('http://127.0.0.1:8000/setor', { waitUntil: 'domcontentloaded', timeout: 10000 });
      await page2.screenshot({ path: 'screenshots/5_setor.png' });
  } catch(e) { console.log('Error Setor', e.message); }

  console.log('Capturing Tarik...');
  try {
      await page2.goto('http://127.0.0.1:8000/tarik', { waitUntil: 'domcontentloaded', timeout: 10000 });
      await page2.screenshot({ path: 'screenshots/6_tarik.png' });
  } catch(e) { console.log('Error Tarik', e.message); }

  await browser.close();
  console.log('Done!');
})();
