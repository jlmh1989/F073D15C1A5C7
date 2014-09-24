USE `e24db`;
CREATE  OR REPLACE VIEW `tbl_e24_material_detail_view1` AS
    select 
        `temp_cm1`.`fk_cat_material` AS `fk_cat_material`,
        count(`temp_cm1`.`fk_cat_material`) AS `total_stock`
    from
        `tbl_e24_cat_material_detail` `temp_cm1`
    group by `temp_cm1`.`fk_cat_material`;
	
USE `e24db`;
CREATE  OR REPLACE VIEW `tbl_e24_material_detail_view2` AS
		SELECT temp_cm2.fk_cat_material, 
			   count(temp_cm2.fk_cat_material)  actual_stock
		  FROM tbl_e24_cat_material_detail temp_cm2 
		 WHERE temp_cm2.availability = 1
		GROUP BY temp_cm2.fk_cat_material
;

USE `e24db`;
CREATE  OR REPLACE VIEW `tbl_e24_material_level_view1` AS
		SELECT temp_ml1.fk_material, cl1.desc_level  
		 FROM tbl_e24_material_level temp_ml1 
		 JOIN tbl_e24_cat_levels cl1 
		   ON (temp_ml1.fk_level = cl1.pk_level);
		   
USE `e24db`;
CREATE  OR REPLACE VIEW `tbl_e24_materials_view` AS
SELECT cm1.pk_material, 
	   cm1.desc_material, 
	   cm1.fk_type_material, 
	   cd1.desc_cat_detail_es,   
	   mdv1.total_stock, 
       IF(mdv2.actual_stock IS NULL, 0, mdv2.actual_stock) actual_stock,
       mlv1.desc_level
FROM tbl_e24_cat_material  cm1
JOIN tbl_e24_cat_detail cd1 ON (cm1.fk_type_material = cd1.pk_cat_detail )
LEFT JOIN tbl_e24_material_detail_view1 mdv1 ON (cm1.pk_material = mdv1.fk_cat_material ) 
LEFT JOIN tbl_e24_material_detail_view2 mdv2 ON (cm1.pk_material = mdv2.fk_cat_material) 
JOIN tbl_e24_material_level_view1  mlv1 ON (cm1.pk_material = mlv1.fk_material ) ;
