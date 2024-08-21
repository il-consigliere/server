create table if not exists organizations
(
  id int unsigned auto_increment primary key,
  title varchar(64) not null
) engine = InnoDB
  default charset = utf8mb4;
