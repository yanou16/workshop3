<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Covers;

require_once __DIR__ . '/../models/UploadModel.php';

#[CoversClass(UploadModel::class)]
class UploadTest extends TestCase
{
    private $uploadModel;
    private $testUploadDir;

    protected function setUp(): void
    {
        // Create test directories
        $this->testUploadDir = __DIR__ . '/test_uploads/';
        $fixturesDir = __DIR__ . '/fixtures/';
        
        if (!is_dir($this->testUploadDir)) {
            mkdir($this->testUploadDir);
        }
        if (!is_dir($fixturesDir)) {
            mkdir($fixturesDir);
        }

        // Create test files if they don't exist
        $testPdfPath = $fixturesDir . 'test_cv.pdf';
        if (!file_exists($testPdfPath)) {
            file_put_contents($testPdfPath, 'Test PDF content');
        }

        $this->uploadModel = new UploadModel($this->testUploadDir, true);
    }

    #[Covers('UploadModel::uploadFile')]
    public function testValidPDFUpload()
    {
        $testFile = [
            'name' => 'test_cv.pdf',
            'type' => 'application/pdf',
            'tmp_name' => __DIR__ . '/fixtures/test_cv.pdf',
            'error' => UPLOAD_ERR_OK,
            'size' => 1024 // 1KB
        ];

        $result = $this->uploadModel->uploadFile($testFile);
        
        $this->assertNotFalse($result);
        $this->assertFileExists($this->testUploadDir . $result);
    }

    #[Covers('UploadModel::uploadFile')]
    public function testInvalidFileType()
    {
        $testFile = [
            'name' => 'test.exe',
            'type' => 'application/x-msdownload',
            'tmp_name' => __DIR__ . '/fixtures/test.exe',
            'error' => UPLOAD_ERR_OK,
            'size' => 1024
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Type de fichier non autorisé");
        
        $this->uploadModel->uploadFile($testFile);
    }

    #[Covers('UploadModel::uploadFile')]
    public function testFileTooLarge()
    {
        $testFile = [
            'name' => 'large_cv.pdf',
            'type' => 'application/pdf',
            'tmp_name' => __DIR__ . '/fixtures/large_cv.pdf',
            'error' => UPLOAD_ERR_OK,
            'size' => 3145728 // 3MB
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("La taille du fichier dépasse la limite autorisée");
        
        $this->uploadModel->uploadFile($testFile);
    }

    protected function tearDown(): void
    {
        // Nettoyer les fichiers de test après chaque test
        array_map('unlink', glob("$this->testUploadDir/*.*"));
        rmdir($this->testUploadDir);
    }
}