#include "cjsonparser.h"
CJsonParser* CJsonParser::parserInst;

CJsonParser::CJsonParser()
{

}

CJsonParser::~CJsonParser()
{

}

CJsonParser* CJsonParser::getParser(){
	if(!parserInst){
		parserInst = new CJsonParser();
		struct Eraser{
			~Eraser(){delete parserInst; }
		};
		static Eraser eraser;
	}
	return  parserInst;
}


void CJsonParser::setData(const QString & _data){
	QJsonDocument document = QJsonDocument::fromJson(_data.toUtf8());
	data = document.object();
	emit dataModified();
}

const QStringList& CJsonParser::getDataList(const QString & key, const QString & _data){
	dataList.clear();
	auto items = data.toVariantMap()[key];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		dataList.append(mapa.find(_data).value().toString());
	}
	return dataList;
}

QString CJsonParser::findData(const QString & descr, const QString & key, const QString & lValue){
	//dataList.clear();
	auto items = data.toVariantMap()[descr];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		auto values = mapa.values();
		for (auto elem : values.toVector()) {
			if(elem.toString() == key)
			{
				return mapa.find(lValue).value().toString();
			}
		}
	}
	return nullptr;
}
