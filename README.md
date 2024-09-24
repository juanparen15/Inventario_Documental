<p align="center">
    <img src="https://www.idamptoboy.com/homeland/images/about.jpg" width="400" alt="IDAM Puerto Boyacá Logo">
</p>

<p align="center">
<a href="https://github.com/username/idamptoboy/actions"><img src="https://github.com/username/idamptoboy/actions/workflows/ci.yml/badge.svg" alt="Build Status"></a>
<a href="https://github.com/username/idamptoboy/releases"><img src="https://img.shields.io/github/v/release/username/idamptoboy" alt="Latest Release"></a>
<a href="https://github.com/username/idamptoboy/blob/main/LICENSE.md"><img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License"></a>
<a href="https://packagist.org/packages/username/idamptoboy"><img src="https://poser.pugx.org/username/idamptoboy/d/total.svg" alt="Total Downloads"></a>
</p>

# IDAM Puerto Boyacá

**IDAM Puerto Boyacá** es una plataforma web que centraliza la gestión de archivos y documentos de la Alcaldía Municipal de Puerto Boyacá. El sistema permite la gestión de archivos físicos y electrónicos, organizados según las normativas vigentes para garantizar un manejo eficiente, transparente y accesible de la información.

## Funcionalidades Principales

- **Gestión de archivos físicos y electrónicos**: Registro y administración de documentos físicos y digitales asociados a diferentes áreas administrativas y oficinas productoras.
- **Consulta y visualización**: Acceso fácil a los documentos mediante criterios como nombre de serie, subserie, fechas, número de folios, soporte y más.
- **Descarga de archivos electrónicos**: Descarga de archivos PDF directamente desde la plataforma para facilitar el acceso a documentos importantes.
- **Auditoría y control**: Registro de entrada y actualización de documentos, permitiendo un control completo sobre las modificaciones realizadas en el sistema.
- **Gestión de usuarios**: Asignación de roles para garantizar un acceso controlado y seguro según el nivel de autorización.

## Tecnologías Utilizadas

- **[Laravel](https://laravel.com/)**: Framework PHP para el backend, utilizado para construir el sistema y su arquitectura robusta.
- **[Jetstream](https://jetstream.laravel.com/)**: Proporciona la interfaz de usuario para la autenticación y el manejo de usuarios.
- **Base de datos**: MySQL es utilizada para almacenar toda la información relacionada con los documentos, usuarios y actividades del sistema.
- **Almacenamiento de archivos**: Los documentos electrónicos se almacenan en un sistema de archivos seguro y están accesibles mediante descargas controladas.

## Requisitos del Sistema

- PHP >= 7.4.19
- Composer
- MySQL >= 5.7
- Node.js y NPM (para el manejo de activos y compilación de JavaScript)
- Extensiones de PHP: `fileinfo`, `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`

## Instalación

Sigue estos pasos para instalar el proyecto localmente:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/juanparen15/Inventario_Documental.github.io.git
   cd Inventario_Documental
