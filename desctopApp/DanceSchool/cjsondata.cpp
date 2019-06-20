#include "cjsondata.h"
CJsonData* CJsonData::dataInst;

CJsonData::CJsonData()
{

}

CJsonData::~CJsonData()
{

}

CJsonData* CJsonData::getInstance(){
	if(!dataInst){
		dataInst = new CJsonData();
		struct Eraser{
			~Eraser(){delete dataInst;}
		};
		static Eraser eraser;
	}
	return dataInst;
}

void CJsonData::setData(const QString & key, const QString & value){
	data[key] = value;
}

void CJsonData::clearData(){
	auto item = data.begin();
	while ((item = data.erase(item)) != data.end()) {}
}
