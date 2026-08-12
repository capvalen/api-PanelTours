# Workflow

## Schema / Migraciones
- Prefiere que los cambios de esquema (agregar campos) se hagan editando/creando migraciones, no alterando la base de datos directamente. Confidence: 0.9
- Prefiere consolidar campos nuevos editando la migración original de creación de la tabla en lugar de crear migraciones adicionales separadas, y eliminar la migración nueva que quede redundante. Confidence: 0.7
- Al agregar un campo, espera que se revisen y actualicen también los models (fillable, casts) y los controladores correspondientes. Confidence: 0.7
