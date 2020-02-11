# viejoalmacen
Sistema Web de Gestión de Viandas e Impresión de Remitos para empresa de catering

# El sistema cuenta con los siguientes gestores
Usuarios
- El superusuario puede crear, editar y eliminar usuarios del sistema, quienes pueden tener rol de
Administradores o de Usuarios Normales. Estos ultimos solo tienen acceso a visualizar la informacion.
Los primeros a editarla y/o eliminarla.

Unidades de Medida
- Estas no son modificables, existen 5 unidades: Kilo, Litro, Gramo, Centímetro cúbico y Unidad.

Ingredientes
- El sistema permite la carga de ingredientes, que tienen un nombre, una unidad de medida y un precio por cada 
unidad de medida.

- Clientes
Los clientes son quienes consumen viandas preestablecidas.

- Viandas
Las viandas pertenecen a un cliente y estan formada por ingredientes y una cantidad establecida de cada uno de estos

# Funcionalidades 
- Las dos funcionalidades principales del sistema son
- Impresion de remitos
En el apartado principal del sistema, el usuario podrá seleccionar un cliente. Una vez hecho esto podra 
elegir el tipo de vianda que le entregará al cliente (Comedor, DMC o ambas), una vez seleccionado esto se eligen
los cupos de cada uno. Se selecciona una fecha, y con esos datos se crea el remito en PDF, que puede imprirse

- Gestion de precios 
Al crear un ingrediente se coloca su precio. Esto permite conocer el precio exacto de cada una de las viandas.
Al modificarse un precio de un ingrediente, se deberán modificar todos los precios de las viandas que lo contengan.

#Plugins Necesarios

AdminLTE3
jQuery
BootsTrap 4
DataTables
Select2
SweetAlert2
Font Awesome
ICheck

#Extensiones
TCPDF


#2do Commit:
- Todos los gestores (CRUDS) ya estan desarrollados en su totalidad.
- Esta en fase de desarrollo el módulo de impresion de remitos.

#Lo que sigue
- Hay que crear la funcionalidad para actualizar los precios de las viandas cuando se actualiza el precio de un ingrediente
- Hay que agregar clases de boostrap a todos los elementos para hacer el sistema responsivo
- Hay que verificar el formato del precio de la vianda cuando se crea.
- Hay que arreglar un error cuando se Edita un ingrediente desde dispositivos móviles (error en ingredientes.js linea:75)
