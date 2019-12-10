INSERT INTO users (name, email, password)
VALUES 
('kste', 'kste.web@gmail.com', 'rfhty1989'),
('karen', 'karen1989@mail.ru', 'cntgfyzyw1989');

INSERT INTO projects (name, user_id)
VALUES 
('Входящие', (SELECT id FROM users WHERE name = 'kste')),
('Учеба', (SELECT id FROM users WHERE name = 'kste')),
('Работа', (SELECT id FROM users WHERE name = 'kste')),
('Домашние дела', (SELECT id FROM users WHERE name = 'kste')),
('Авто', (SELECT id FROM users WHERE name = 'kste'));

INSERT INTO tasks (name, dt_do, project_id, user_id, status)
VALUES 
('Собеседование в IT компании', '01.12.2019', 3 , (SELECT id FROM users WHERE name = 'kste'), 0),
('Выполнить тестовое задание', '25.12.2019', 3 , (SELECT id FROM users WHERE name = 'kste'), 0),
('Сделать задание первого раздела', '21.12.2019', 2 , (SELECT id FROM users WHERE name = 'kste'), 1),
('Встреча с другом', '22.12.2019', 1 , (SELECT id FROM users WHERE name = 'kste'), 0),
('Купить корм для кота', null , 4 , (SELECT id FROM users WHERE name = 'kste'), 0),
('Заказать пиццу', null, 4 , (SELECT id FROM users WHERE name = 'kste'), 0);


SELECT name FROM projects WHERE user_id = 1;
SELECT name FROM tasks WHERE project_id = 1;
UPDATE tasks SET status = 1 WHERE id = 27;
UPDATE tasks SET name = 'новая задача' WHERE id = 27;

