create table if not exists teams
(
  id int unsigned auto_increment primary key,
  title varchar(64) not null
) engine = InnoDB
  default charset = utf8mb4;

create table if not exists roles
(
  id int unsigned auto_increment primary key,
  title varchar(64) not null,
  team_id int unsigned not null,
  foreign key (team_id) references teams(id)
) engine = InnoDB
  default charset = utf8mb4;

create table if not exists organizations
(
  id int unsigned auto_increment primary key,
  title varchar(64) not null
) engine = InnoDB
  default charset = utf8mb4;

create table if not exists masters
(
  id int unsigned auto_increment primary key,
  name varchar(64) not null unique,
  password char(64) not null,
  organization_id int unsigned not null,
  foreign key (organization_id) references organizations(id)
) engine = InnoDB
  default charset = utf8mb4;

create table if not exists players
(
  id int unsigned auto_increment primary key,
  name varchar(64) not null,
  comment varchar(256) not null,
  master_id int unsigned not null,
  organization_id int unsigned not null,
  foreign key (master_id) references masters(id),
  foreign key (organization_id) references organizations(id)
) engine = InnoDB
  default charset = utf8mb4;

create table if not exists games
(
  id int unsigned auto_increment primary key,
  master_id int unsigned not null,
  organization_id int unsigned not null,
  winning_team_id int unsigned not null,
  created_at timestamp not null default current_timestamp,
  foreign key (master_id) references masters(id),
  foreign key (winning_team_id) references teams(id),
  foreign key (organization_id) references organizations(id)
) engine = InnoDB;

create table if not exists players_in_games
(
  player_id int unsigned not null,
  game_id int unsigned not null,
  role_id int unsigned not null,
  primary key (player_id, game_id),
  foreign key (player_id) references players(id),
  foreign key (game_id) references games(id),
  foreign key (role_id) references roles(id)
) engine = InnoDB;
