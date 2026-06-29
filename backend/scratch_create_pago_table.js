const userDb = require('./db/userDb');

async function run() {
  const sql = `
    CREATE TABLE IF NOT EXISTS pago (
      id               INT(11) NOT NULL AUTO_INCREMENT,
      socio_id         INT(11) NOT NULL,
      cod_mevep        INT(10) DEFAULT NULL,
      mes              VARCHAR(2) NOT NULL COMMENT '01-12',
      anio             SMALLINT(4) NOT NULL,
      importe          DECIMAL(10,2) NOT NULL DEFAULT 0,
      cobrador         VARCHAR(5) DEFAULT NULL,
      metodo_pago      ENUM('EFECTIVO','TRANSFERENCIA','TARJETA','CHEQUE','OTRO') DEFAULT 'EFECTIVO',
      estado           ENUM('PENDIENTE','PAGADO','ANULADO') NOT NULL DEFAULT 'PENDIENTE',
      nro_boleta       VARCHAR(10) DEFAULT NULL,
      observaciones    TEXT DEFAULT NULL,
      fecha_generacion DATE NOT NULL,
      fecha_pago       DATE DEFAULT NULL,
      tipo_creacion    TINYINT(1) NOT NULL DEFAULT 0,
      CreacionUsuario  VARCHAR(255) DEFAULT NULL,
      FechaCreacion    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      ModificacionUsuario VARCHAR(255) DEFAULT NULL,
      FechaModificacion   TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (id),
      UNIQUE KEY uq_pago (socio_id, mes, anio),
      KEY idx_estado (estado),
      KEY idx_cobrador (cobrador),
      KEY idx_nro_boleta (nro_boleta),
      KEY fk_pago_socio (socio_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  `;

  try {
    await userDb.query(sql);
    console.log('Tabla pago creada OK');
    const cols = await userDb.query('DESCRIBE pago');
    cols.forEach(c => console.log(c.Field, '-', c.Type));
  } catch (e) {
    console.error('ERROR:', e.message);
  }
  process.exit(0);
}
run();
