import os

theme_dirs = [
    r'C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal\theme',
    r'C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal\wordpress\wp-content\themes\clinica-vocal'
]

replacements = [
    ('Calle Sierra de Tormantos, 16, Local 3', 'Calle Sierra de Tormantos, 22'),
    ('C/ Sierra de Tormantos, 16, Local 3', 'C/ Sierra de Tormantos, 22'),
    ('Sierra de Tormantos, 16, Local 3', 'Sierra de Tormantos, 22'),
    ('Calle Sierra de Tormantos, 16', 'Calle Sierra de Tormantos, 22'),
    ('C/ Sierra de Tormantos, 16', 'C/ Sierra de Tormantos, 22'),
    ('Sierra de Tormantos, 16', 'Sierra de Tormantos, 22'),
    ('Sierra+de+Tormantos+16', 'Sierra+de+Tormantos+22'),
    ('Sierra%20de%20Tormantos%2C%2016', 'Sierra%20de%20Tormantos%2C%2022'),
    ('Sierra%20de%20Tormantos%2016', 'Sierra%20de%20Tormantos%2022')
]

for td in theme_dirs:
    for root, dirs, files in os.walk(td):
        for f in files:
            if f.endswith(('.php', '.css', '.js', '.html')):
                p = os.path.join(root, f)
                with open(p, 'r', encoding='utf-8', errors='ignore') as fl:
                    content = fl.read()
                updated = content
                for old, new in replacements:
                    updated = updated.replace(old, new)
                if updated != content:
                    with open(p, 'w', encoding='utf-8') as fl:
                        fl.write(updated)
                    print(f"Updated theme file: {p}")
