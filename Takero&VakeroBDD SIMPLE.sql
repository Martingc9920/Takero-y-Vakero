        Drop database if exists TyVBDD;
        create database TyVBDD;
        use TyVBDD;
        
        CREATE TABLE trabajador(
            id_trabajador INT PRiMARY KEY Auto_Increment, 
            nombre VARCHAR(40),
            apellido_p VARCHAR(40),
            apellido_m VARCHAR(40),
            estado VARCHAR (40),
            puesto VARCHAR (40),
            celular float (15),
            correo VARCHAR(40),    
            estado_trabajador boolean
        );

        CREATE TABLE usuario(
            id_usuario INT PRiMARY KEY Auto_Increment,             
            id_trabajador INT,
            username VARCHAR(40),         
            password VARCHAR(40),  
            administrador boolean,
            foreign KEY (id_trabajador) references trabajador(id_trabajador)                        
        );

        CREATE TABLE direccion(
            id_direccion INT PRiMARY KEY Auto_Increment,
            id_trabajador INT,
            num_direccion INT (4),
            num_ext_direccon varchar(4),
            calle VARCHAR (255),
            colonia VARCHAR (40),
            localidad VARCHAR (40),            
            municipio VARCHAR (40),
            estado VARCHAR (40),
            foreign KEY (id_trabajador) references trabajador(id_trabajador)                        
        );
        
        CREATE TABLE metodo_pago(
            id_metodo_pago INT PRiMARY KEY,
            nombre_metodo VARCHAR(40),
            disponibilidad BOOLEAN            
        );

        CREATE TABLE venta(
            id_venta INT PRiMARY KEY Auto_Increment,
            fecha datetime,        
            mesa INT(3),         
            id_usuario int,
            id_metodo_pago int,
            total_pago float (10,2),                
            foreign KEY (id_usuario) references usuario(id_usuario),
            foreign KEY (id_metodo_pago) references metodo_pago(id_metodo_pago)
        
        );

        

        CREATE TABLE medicion(
            id_medicion INT PRIMARY KEY Auto_Increment,
            nombre_medicion VARCHAR(40),
            abreviacion VARCHAR(10)
        );

        CREATE TABLE insumo(
            id_insumo INT PRiMARY KEY Auto_Increment, 
            nombre_insumo VARCHAR(40),         
            cantidad float(8,2),   
            id_medicion int,
            insumo_minimo float(8,2),   
            foreign KEY (id_medicion) references medicion(id_medicion)
        );
        

        CREATE TABLE categoria(
            id_categoria INT PRiMARY KEY Auto_Increment, 
            nombre_categoria VARCHAR(40),
            descripcion varchar(500)
        );

        CREATE TABLE producto(
            id_producto INT PRiMARY KEY Auto_Increment, 
            nombre_producto VARCHAR(40),
            precio float (8,2),
            descripcion text(500),
            id_categoria int,
            estado_producto boolean,            
            foreign KEY (id_categoria)references categoria(id_categoria)         
        );

        CREATE TABLE inventario(
            id_inventario int PRiMARY KEY Auto_Increment,
            id_producto INT,
            cantidad int(5),
            foreign KEY (id_producto)references producto(id_producto)         
        );
    
        CREATE TABLE producto_insumo(
            id_producto int, 
            id_insumo int,
            gasto_de_insumo float(8,2),
            foreign KEY (id_producto)references producto(id_producto),  
            foreign KEY (id_insumo)references insumo(id_insumo)   
        );
        
        CREATE TABLE producto_venta(
            id_producto int, 
            id_venta int,
            cantidad int,
            foreign KEY (id_producto)references producto(id_producto),  
            foreign KEY (id_venta)references venta(id_venta)   
        );