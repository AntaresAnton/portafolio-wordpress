@echo off
setlocal enabledelayedexpansion

:: Solicitar el nombre del tema
set /p tema=Ingrese el nombre del tema de WordPress: 

:: Crear la carpeta principal del tema
mkdir "%tema%"
cd "%tema%"

:: Crear archivos principales
echo. > style.css
echo. > index.php
echo. > functions.php
echo. > header.php
echo. > footer.php
echo. > sidebar.php
echo. > single.php
echo. > page.php
echo. > archive.php
echo. > search.php
echo. > 404.php
echo. > comments.php

:: Crear carpetas y subcarpetas
mkdir assets\css assets\js assets\images
mkdir inc
mkdir template-parts
mkdir languages

:: Crear archivos en subcarpetas
echo. > assets\css\main.css
echo. > assets\js\main.js
echo. > inc\customizer.php
echo. > inc\template-functions.php
echo. > template-parts\content.php
echo. > template-parts\content-page.php
echo. > template-parts\content-search.php

echo Estructura del tema de WordPress creada exitosamente en la carpeta "%tema%"
pause
