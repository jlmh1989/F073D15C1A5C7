USE `e24db`;
CREATE  OR REPLACE VIEW `tbl_e24_material_detail_view1` AS
    select 
        `temp_cm1`.`fk_cat_material` AS `fk_cat_material`,
        count(`temp_cm1`.`fk_cat_material`) AS `total_stock`
    from
        `tbl_e24_cat_material_detail` `temp_cm1`
    group by `temp_cm1`.`fk_cat_material`;