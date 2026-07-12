const { chromium } = require('playwright');
const path = require('path');

(async () => {
  const browser = await chromium.launch({ headless: true });
  const page = await browser.newPage();
  
  // Navigate to the local file
  const reportPath = 'file://' + path.resolve('playwright-report/index.html');
  await page.goto(reportPath, { waitUntil: 'networkidle' });
  
  // Set viewport to a good size
  await page.setViewportSize({ width: 1200, height: 800 });
  
  // Take screenshot
  await page.screenshot({ path: 'screenshots/playwright_report.png', fullPage: true });
  
  await browser.close();
  console.log('HTML Report screenshot captured!');
})();
