# Prueba Técnica: Módulo de Compra a Proveedores.
---

# Proyecto desplegado en: https://adecompras.infinityfreeapp.com/users/login

### Base de Datos:
  - En la raíz del Proyecto GitHub, se encuentra una carpeta "Anotaciones del Proyecto", ahí encontrarás dentro la Base de Datos.

---

## 📖 Descripción

Este módulo permite gestionar los **Usuarios** que ingresaran al sistema, además de los **Proveedores** así como también poder realizar un **circuito de Compras** con detalles (producto, cantidad, precio, etc.), integrando la exportación en PDF de las Ordendes de Compras realizadas con cálculos automáticos y marca de agua de “ANULADA” si es que el estado de la OC fue cambiada.

---

## 🛠️ Tecnologías

- **Framework:** CakePHP 3.10.5  
- **Base de datos:** MySQL  
- **Frontend:** Bootstrap 4 y AdminLTE.
- **PDF:** CakePdf (Dompdf) intenté usar DomPDF, en Desarrollo funciona perfecto pero, parece que el servidor InfinityFree tiene problemas para procesar PDF, entonces opté por la siguiente solución. 
              Consumí una API ShitPDF, con la cual me cree una cuenta, me otorgaron 50 créditos grauitos, eso significa que se podrán descargar actualmente 45 PDF menos los de prueba que yo utilicé.
- **Servidor demo:** InfinityFree

---

##  Características Principales del Proyecto

- **ABM de Usuarios** 
  - Login de usuario
- **ABM de Proveedores**  
  - Listado paginado, filtrado en tiempo real y validaciones de formulario.  
- **Orden de Compra**
  - Selección de Proveedor y Fecha  
  - Detalle de ítems: producto, cantidad, precio unitario, bonificacion, IVA.
  - Cálculo automático de subtotales, IVA y totales.
- **Generación de PDF de la Orden de Compra**  
  - Marca de agua de “ANULADA”  si el estado de la orden está anulada.

---

## ✨ Futuros cambios que se me ocurren por ahora para agregar al Proyecto:

- Agregar fecha del último Login que realizo el usuario.
- Agregar Roles de usuario.
- Cuando se Anule una OC, identificar quién (Usuario) y cuando se realizó.
- Cuando se anule una OC. Ofrecer la opción de Nota de Credito si ya se facturó.
- Ocultar el boton eliminar si el estado de la OC está "Anulada".

---

## 🚀 Instalación Local

1. Clonar el repositorio:
   ```bash
   git https://github.com/GitKoteSoft/adecoAGRO.git
