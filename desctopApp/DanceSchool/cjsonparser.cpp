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
QString CJsonParser::findData(const QString & descr, const QString & key, const QString & lValue, const QString & lValue2){
	//dataList.clear();
	auto items = data.toVariantMap()[descr];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		auto values = mapa.values();
		int coincidence = 0;
		for (auto elem : values.toVector()) {
			if(elem.toString() == key)
			{
				coincidence |=1;
			}
			if(elem.toString() == lValue)
			{
				coincidence |=2;
			}
			if(coincidence == 3){
				return mapa.find(lValue2).value().toString();
			}
		}
	}
	return nullptr;
}

QString CJsonParser::findData(const QString & descr, const QString & key, const QString & lValue, const QString & lValue2, const QString & lValue3){
	//dataList.clear();
	auto items = data.toVariantMap()[descr];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		auto values = mapa.values();
		int coincidence = 0;
		for (auto elem : values.toVector()) {
			if(elem.toString() == key)
			{
				coincidence |=1;
			}
			if(elem.toString() == lValue)
			{
				coincidence |=2;
			}
			if(elem.toString() == lValue2)
			{
				coincidence |=4;
			}
			if(coincidence == 7){
				return mapa.find(lValue3).value().toString();
			}
		}
	}
	return nullptr;
}

const QStringList& CJsonParser::findListData(const QString & descr, const QString & key, const QString & lValue){
	dataList.clear();
	auto items = data.toVariantMap()[descr];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		auto values = mapa.values();
		for (auto elem : values.toVector()) {
			if(elem.toString() == key)
			{
				dataList.append(mapa.find(lValue).value().toString());
			}
		}
	}
	return dataList;
}
const QStringList& CJsonParser::findListData(const QString & descr, const QString & key, const QString & lValue, const QString & lValue2){
	dataList.clear();
	auto items = data.toVariantMap()[descr];
	auto datalist = items.toList();
	for (auto item:datalist) {
		auto mapa = item.toMap();
		auto values = mapa.values();
		int coincidence = 0;
		for (auto elem : values.toVector()) {
			if(elem.toString() == key)
			{
				coincidence |=1;
			}
			if(elem.toString() == lValue)
			{
				coincidence |=2;
			}
			if(coincidence == 3){
				dataList.append(mapa.find(lValue2).value().toString());
			}
		}
	}
	return dataList;
}
