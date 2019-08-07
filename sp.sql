   INSUMOS DEL PRODUCTO
        select *  from  producto_insumo where id_producto =1 and 1=1; 

        NO. DE REPETICIONES (NUMERO DE INSUMOS DEL PRODUCTO)
        select count(*)  from  producto_insumo where id_producto =1 and 1=1 ; 

        ELECTOR DE FILA
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1 ;  --Primero
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  0,1 ;  --Primero
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1,1; --Segundo  
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1,2;  --Segundo Doble
        ELECTOR DE FILA
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1 ;  --Primero
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  0,1 ;  --Primero
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1,1; --Segundo  
        select id_insumo  from  producto_insumo where id_producto =6 and 1=1  Limit  1,2;  --Segundo Doble

  drop procedure upd;
        select * from insumo;
        
        DELIMITER $$
                CREATE PROCEDURE upd(producto int, repeticiones int) 
                BEGIN
                DECLARE counter int default 0;        	                
                DECLARE limite int;       
                DECLARE gasto float; 
                DECLARE insumo int;
                DECLARE iminimo float;
                DECLARE icantidad float;
                select count(*) into limite from  producto_insumo where id_producto =producto and 1=1 ;                 

                select limite;
                my_loop: LOOP
                                        
                    IF counter < limite THEN
                                                                    
                        select id_insumo into insumo from  producto_insumo where id_producto =producto and 1=1  Limit  counter,1 ;    
                        select gasto_de_insumo into gasto from producto_insumo where id_insumo = insumo and id_producto = producto;                                                
                        UPDATE insumo SET cantidad= cantidad - (gasto * repeticiones) where id_insumo = insumo;


                        select cantidad into icantidad from insumo where id_insumo = insumo;
                        select insumo_minimo into iminimo from insumo where id_insumo = insumo                        
                        
                        IF canitdad <= insumo_minimo then 
                            update producto set estado_producto = false WHERE id_producto = producto; 
                        end If;


                        
                    else
                        LEAVE my_loop;
                    END IF;                        
                    SET counter=counter+1;                    
                END LOOP my_loop;
                END$$


        DELIMITER ;
        CAll upd(6,1);
        select * from insumo;
        Select "Me" as mensaje;