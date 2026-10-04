import json

data_path = "c:/Users/Asus/aysenur-portfolio/src/data.json"
with open(data_path, "r", encoding="utf-8") as f:
    data = json.load(f)

# Update hero text to focus on continuous improvement
data["profile"]["tagline"]["en"] = "Continuously learning and improving every day to build scalable backend systems and native mobile apps."
data["profile"]["tagline"]["tr"] = "Ölçeklenebilir backend sistemleri ve native mobil uygulamalar geliştirmek için her gün yeni bir şeyler öğreniyor ve kendimi geliştiriyorum."

data["profile"]["description"]["en"] = "I design and build REST APIs, backend services, and iOS applications. My focus isn't just on writing code, but on improving my engineering skills every single day. I prioritize clean code, maintainable architecture, and solving real-world problems efficiently."
data["profile"]["description"]["tr"] = "REST API'ler, backend servisleri ve iOS uygulamaları tasarlayıp geliştiriyorum. Sadece kod yazmakla kalmıyor, her yeni günde mühendislik becerilerimi bir adım öteye taşımak için aralıksız çalışıyorum. Odak noktam her zaman temiz kod, sürdürülebilir mimari ve gerçek dünya problemlerine yenilikçi çözümler üretmek."

with open(data_path, "w", encoding="utf-8") as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

print("Hero text updated in data.json")
