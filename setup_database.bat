@echo off
echo Setting up GECO RWANDA Database...
echo.

REM Check if PHP is available
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: PHP is not installed or not in PATH
    echo Please install PHP and add it to your PATH
    pause
    exit /b 1
)

REM Run the migration
echo Running database migration...
php run_migration.php

if %errorlevel% equ 0 (
    echo.
    echo SUCCESS! Database setup completed.
    echo You can now run: npm run dev
) else (
    echo.
    echo FAILED! Database setup encountered errors.
    echo Please check the error messages above.
)

echo.
pause
