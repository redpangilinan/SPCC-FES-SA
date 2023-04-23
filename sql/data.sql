INSERT INTO
    tb_users (
        user_type,
        email,
        password,
        firstname,
        lastname
    )
VALUES (
        'admin',
        'main.admin@gmail.com',
        '$2y$10$2a6suV9Wa9TtmZJW6RAKjOVlFKybXxz.eARFqMCASyZket9HYP6Hi',
        'ADMIN',
        'MAIN'
    );

INSERT INTO
    tb_activation_codes (
        activation_code,
        activation_type
    )
VALUES ('ABC123', 'faculty');

INSERT INTO
    tb_activation_codes (
        activation_code,
        activation_type
    )
VALUES ('DEF456', 'admin');

INSERT INTO
    tb_api_keys (user_id, api_name, key_value)
VALUES (1, 'OpenAI API Key', '');