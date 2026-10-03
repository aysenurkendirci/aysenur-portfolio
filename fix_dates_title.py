import json

# Fix data.json
data_path = "c:/Users/Asus/aysenur-portfolio/src/data.json"
with open(data_path, "r", encoding="utf-8") as f:
    data = json.load(f)

# Update profile title
data["profile"]["title"]["en"] = "Software Engineering Student | Backend Developer | C#/.NET"
data["profile"]["title"]["tr"] = "Yazılım Mühendisliği Öğrencisi | Backend Geliştirici | C#/.NET"

# Update experience dates to be dicts
for exp in data["experiences"]:
    old_date = exp["date"]
    if isinstance(old_date, str):
        # Translate month names
        month_map = {
            "Jan": "Oca", "Feb": "Şub", "Mar": "Mar", "Apr": "Nis",
            "May": "May", "Jun": "Haz", "Jul": "Tem", "Aug": "Ağu",
            "Sep": "Eyl", "Oct": "Eki", "Nov": "Kas", "Dec": "Ara"
        }
        tr_date = old_date
        for en_m, tr_m in month_map.items():
            tr_date = tr_date.replace(en_m, tr_m)
        
        exp["date"] = {
            "en": old_date,
            "tr": tr_date
        }

with open(data_path, "w", encoding="utf-8") as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

# Fix experience.html template
exp_html_path = "c:/Users/Asus/aysenur-portfolio/src/components/experience.html"
with open(exp_html_path, "r", encoding="utf-8") as f:
    exp_html = f.read()

exp_html = exp_html.replace('<span class="experience-date">{{date}}</span>', '<span class="experience-date" data-en="{{date.en}}" data-tr="{{date.tr}}">{{date.en}}</span>')

with open(exp_html_path, "w", encoding="utf-8") as f:
    f.write(exp_html)

print("data.json and experience.html fixed")
