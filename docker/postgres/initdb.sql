SELECT 'CREATE DATABASE praqtdb' WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'praqtdb')\gexec