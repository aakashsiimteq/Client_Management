create table customers
(
  customer_id               int unsigned auto_increment primary key,
  customer_number           varchar(255)                            not null,
  customer_name             varchar(255)                            not null,
  customer_type             enum ('company', 'individual', 'other') null,
  customer_abn_no           varchar(255)                            null,
  customer_email            varchar(255)                            null,
  customer_contact_no       varchar(255)                            null,
  customer_physical_address varchar(255)                            null,
  customer_billing_address  varchar(255)                            null,
  created_at                timestamp                               null,
  updated_at                timestamp                               null,
  constraint customers_customer_number_unique
  unique (customer_number),
  constraint customers_customer_email_unique
  unique (customer_email),
  constraint customers_customer_contact_no_unique
  unique (customer_contact_no)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table invoices
(
  invoice_id              int unsigned auto_increment primary key,
  invoice_number          varchar(255)                                    not null,
  customer_id             int unsigned                                    not null,
  project_id              int unsigned                                    not null,
  invoice_gst_rate        double(8, 2) unsigned                           null,
  invoice_final_cost      double unsigned                                 not null,
  invoice_date            date                                            not null,
  invoice_status          enum ('Open', 'Close')                          not null,
  invoice_copy_type       enum ('By hand', 'By Email')                    null,
  invoice_payment_terms   enum ('Credit card', 'Cash', 'Cheque', 'Other') not null,
  invoice_billing_address varchar(255)                                    not null,
  invoice_comments        text                                            null,
  created_at              timestamp                                       null,
  updated_at              timestamp                                       null,
  constraint invoices_invoice_number_unique
  unique (invoice_number)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table log_payment_details
(
  log_payment_id      int unsigned auto_increment primary key,
  payment_details_id  int unsigned                 not null,
  project_paid_amount double unsigned              not null,
  project_due_amount  double unsigned              not null,
  payment_status      enum ('Pending', 'Complete') not null,
  created_at          timestamp                    null,
  updated_at          timestamp                    null
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table migrations
(
  id        int unsigned auto_increment primary key,
  migration varchar(255) not null,
  batch     int          not null
)
  engine = InnoDB
  collate = utf8mb4_unicode_ci;

create table password_resets
(
  email      varchar(255) not null,
  token      varchar(255) not null,
  created_at timestamp    null
)
  engine = InnoDB
  collate = utf8mb4_unicode_ci;

create index password_resets_email_index
  on password_resets (email);

create table payment_details
(
  payment_details_id   int unsigned auto_increment primary key,
  customer_id          int unsigned                 not null,
  project_id           int unsigned                 not null,
  project_final_amount double unsigned              not null,
  project_paid_amount  double unsigned              null,
  project_due_amount   double unsigned              null,
  last_amount_paid_on  date                         null,
  payment_status       enum ('Pending', 'Complete') not null,
  created_at           timestamp                    null,
  updated_at           timestamp                    null
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table projects
(
  project_id            int unsigned auto_increment primary key,
  project_number        varchar(255)                                                  not null,
  customer_id           int unsigned                                                  not null,
  project_name          varchar(255)                                                  not null,
  project_type          enum ('Website', 'Software', 'Web service', 'Cloud', 'Other') not null,
  project_details       text                                                          null,
  project_status        enum ('On going', 'Complete')                                 null,
  project_start_date    date                                                          null,
  project_end_date      date                                                          null,
  project_per_hour_cost double unsigned                                               not null,
  project_estimate_cost double unsigned                                               not null,
  created_at            timestamp                                                     null,
  updated_at            timestamp                                                     null,
  constraint projects_project_number_unique
  unique (project_number)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table users
(
  id             int unsigned auto_increment primary key,
  name           varchar(255) not null,
  email          varchar(255) not null,
  password       varchar(255) not null,
  remember_token varchar(100) null,
  created_at     timestamp    null,
  updated_at     timestamp    null,
  constraint users_email_unique
  unique (email)
)
  engine = InnoDB
  collate = utf8mb4_unicode_ci;
